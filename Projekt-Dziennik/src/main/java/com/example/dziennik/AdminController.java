package com.example.dziennik;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PathVariable;
import java.util.List;

@Controller
public class AdminController {

    private final AppUserRepository appUserRepository;
    private final RoleRepository roleRepository;

    public AdminController(AppUserRepository appUserRepository, RoleRepository roleRepository) {
        this.appUserRepository = appUserRepository;
        this.roleRepository = roleRepository;
    }

    @GetMapping("/admin")
    public String showAdminPanel(Model model) {
        List<AppUser> allUsers = appUserRepository.findAll();
        model.addAttribute("users", allUsers);
        return "admin";
    }

    @PostMapping("/admin/promote/{id}")
    public String promoteToAdmin(@PathVariable Long id) {
        appUserRepository.findById(id).ifPresent(user -> {
            roleRepository.findByName("ADMIN").ifPresent(adminRole -> {
                if (!user.getRoles().contains(adminRole)) {
                    user.getRoles().add(adminRole);
                    appUserRepository.save(user);
                }
            });
        });
        return "redirect:/admin";
    }
}