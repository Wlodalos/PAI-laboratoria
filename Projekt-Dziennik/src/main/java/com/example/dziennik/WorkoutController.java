package com.example.dziennik;

import org.springframework.web.bind.annotation.*;
import java.security.Principal;
import java.util.List;

@RestController
@RequestMapping("/treningi")
public class WorkoutController {

    private final WorkoutRepository repository;
    private final AppUserRepository userRepository;

    public WorkoutController(WorkoutRepository repository, AppUserRepository userRepository) {
        this.repository = repository;
        this.userRepository = userRepository;
    }

    @GetMapping
    public List<Workout> pobierzMojeTreningi(Principal principal) {
        // Zwraca tylko treningi aktualnie zalogowanego użytkownika
        return repository.findByAppUserUsername(principal.getName());
    }

    @PostMapping
    public Workout dodajTrening(@RequestBody Workout workout, Principal principal) {
        // Znajdujemy w bazie użytkownika po jego loginie
        AppUser user = userRepository.findByUsername(principal.getName())
                .orElseThrow(() -> new RuntimeException("Błąd logowania"));
        
        // Przypisujemy trening do tego użytkownika i zapisujemy
        workout.setAppUser(user);
        return repository.save(workout);
    }

    @DeleteMapping("/{id}")
    public void usunTrening(@PathVariable Long id) {
        repository.deleteById(id);
    }
}