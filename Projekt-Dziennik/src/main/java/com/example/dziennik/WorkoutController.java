package com.example.dziennik;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.GrantedAuthority;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.PathVariable;
import java.security.Principal;
import java.util.List;
import java.util.stream.Collectors;

@Controller
public class WorkoutController {

    private final WorkoutRepository workoutRepository;
    private final AppUserRepository appUserRepository;
    private final RoleRepository roleRepository;

    public WorkoutController(WorkoutRepository workoutRepository, 
                             AppUserRepository appUserRepository,
                             RoleRepository roleRepository) {
        this.workoutRepository = workoutRepository;
        this.appUserRepository = appUserRepository;
        this.roleRepository = roleRepository;
    }

    @GetMapping("/workouts")
    public String getWorkoutsPage(@RequestParam(defaultValue = "0") int page, 
                                 Authentication authentication, 
                                 Model model) {
        
        String username = authentication.getName();
        model.addAttribute("username", username);

        List<String> roles = authentication.getAuthorities().stream()
                .map(GrantedAuthority::getAuthority)
                .collect(Collectors.toList());

        if (roles.contains("ROLE_ADMIN") || roles.contains("ADMIN")) {
            List<AppUser> allUsers = appUserRepository.findAll();
            model.addAttribute("users", allUsers);
            return "admin"; 
        }

        if (roles.contains("ROLE_TRENER") || roles.contains("TRENER")) {
            List<AppUser> allClients = appUserRepository.findAll();
            model.addAttribute("clients", allClients);
            return "trener"; 
        }

        Page<Workout> workoutPage = workoutRepository.findByAppUser_Username(username, PageRequest.of(page, 5));
        model.addAttribute("workoutPage", workoutPage);
        return "workouts"; 
    }


    @GetMapping("/my-workouts")
    public String getMyWorkouts(@RequestParam(defaultValue = "0") int page, 
                                Authentication authentication, 
                                Model model) {
        
        String username = authentication.getName();
        
        List<String> roles = authentication.getAuthorities().stream()
                .map(GrantedAuthority::getAuthority)
                .collect(Collectors.toList());
        model.addAttribute("roles", roles);

        Page<Workout> workoutPage = workoutRepository.findByAppUser_Username(username, PageRequest.of(page, 5));
        model.addAttribute("workoutPage", workoutPage);
        model.addAttribute("username", username);
        
        return "workouts"; 
    }

    @PostMapping("/workouts")
    public String addWorkout(@RequestParam String exerciseName,
                             @RequestParam int weight,
                             @RequestParam int repetitions,
                             Principal principal) {
        
        AppUser user = appUserRepository.findByUsername(principal.getName())
                .orElseThrow(() -> new RuntimeException("Nie znaleziono użytkownika"));
        
        Workout workout = new Workout(exerciseName, weight, repetitions);
        workout.setAppUser(user);
        workoutRepository.save(workout);
        
        return "redirect:/my-workouts"; 
    }

    @GetMapping("/api/workouts/search")
    @ResponseBody
    public Page<Workout> searchWorkoutsAjax(@RequestParam String query, @RequestParam(defaultValue = "0") int page, Principal principal) {
        return workoutRepository.findByAppUser_UsernameAndExerciseNameContainingIgnoreCase(
                principal.getName(), query, PageRequest.of(page, 5));
    }

    @PostMapping("/workouts/delete/{id}")
    public String deleteWorkout(@PathVariable Long id, Principal principal) {
        workoutRepository.findById(id).ifPresent(workout -> {
            if (workout.getAppUser().getUsername().equals(principal.getName())) {
                workoutRepository.delete(workout);
            }
        });
        return "redirect:/my-workouts";
    }

    @GetMapping("/workouts/edit/{id}")
    public String showEditForm(@PathVariable Long id, Principal principal, Model model) {
        Workout workout = workoutRepository.findById(id).orElseThrow(() -> new RuntimeException("Nie znaleziono"));
        
        if (!workout.getAppUser().getUsername().equals(principal.getName())) {
            return "redirect:/my-workouts";
        }
        
        model.addAttribute("workout", workout);
        return "edit-workout";
    }

    @PostMapping("/workouts/edit/{id}")
    public String updateWorkout(@PathVariable Long id,
                                @RequestParam String exerciseName,
                                @RequestParam int weight,
                                @RequestParam int repetitions,
                                Principal principal) {
        workoutRepository.findById(id).ifPresent(workout -> {
            if (workout.getAppUser().getUsername().equals(principal.getName())) {
                workout.setExerciseName(exerciseName);
                workout.setWeight(weight);
                workout.setRepetitions(repetitions);
                workoutRepository.save(workout); 
            }
        });
        return "redirect:/my-workouts";
    }

    @PostMapping("/admin/change-role/{id}")
    public String changeRole(@PathVariable Long id, @RequestParam String newRole) {
        appUserRepository.findById(id).ifPresent(user -> {
            Role role = roleRepository.findByName(newRole).orElseThrow(() -> new RuntimeException("Rola nie istnieje"));
            user.getRoles().clear(); 
            user.getRoles().add(role); 
            appUserRepository.save(user);
        });
        return "redirect:/workouts"; 
    }

    @PostMapping("/admin/delete-user/{id}")
    public String deleteUser(@PathVariable Long id) {
        appUserRepository.deleteById(id);
        return "redirect:/workouts"; 
    }

    @PostMapping("/trener/assign/{clientId}")
    public String assignTrainer(@PathVariable Long clientId, Principal principal) {
        AppUser trainer = appUserRepository.findByUsername(principal.getName())
                .orElseThrow(() -> new RuntimeException("Nie znaleziono trenera"));
        
        appUserRepository.findById(clientId).ifPresent(client -> {
            if (client.getTrainer() == null) {
                client.setTrainer(trainer);
                appUserRepository.save(client);
            }
        });
        return "redirect:/workouts"; 
    }

    @PostMapping("/trener/unassign/{clientId}")
    public String unassignTrainer(@PathVariable Long clientId, Principal principal) {
        appUserRepository.findById(clientId).ifPresent(client -> {
            if (client.getTrainer() != null && client.getTrainer().getUsername().equals(principal.getName())) {
                client.setTrainer(null); 
                appUserRepository.save(client);
            }
        });
        return "redirect:/workouts"; 
    }

    @GetMapping("/trener/plan/{clientId}")
    public String viewClientPlan(@PathVariable Long clientId, Principal principal, Model model) {
        AppUser client = appUserRepository.findById(clientId)
                .orElseThrow(() -> new RuntimeException("Nie znaleziono klienta"));

        if (client.getTrainer() == null || !client.getTrainer().getUsername().equals(principal.getName())) {
            return "redirect:/workouts"; 
        }

        model.addAttribute("client", client);
        model.addAttribute("username", principal.getName()); 

        Page<Workout> workoutPage = workoutRepository.findByAppUser_Username(client.getUsername(), PageRequest.of(0, 50));
        model.addAttribute("workoutPage", workoutPage);

        return "client-plan"; 
    }

    @PostMapping("/trener/plan/{clientId}/add")
    public String addWorkoutForClient(@PathVariable Long clientId,
                                      @RequestParam String exerciseName,
                                      @RequestParam int weight,
                                      @RequestParam int repetitions,
                                      Principal principal) {
        appUserRepository.findById(clientId).ifPresent(client -> {
            if (client.getTrainer() != null && client.getTrainer().getUsername().equals(principal.getName())) {
                Workout workout = new Workout(exerciseName, weight, repetitions);
                workout.setAppUser(client); 
                workoutRepository.save(workout);
            }
        });
        return "redirect:/trener/plan/" + clientId; 
    }
}