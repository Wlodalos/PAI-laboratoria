package com.example.dziennik;

import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/auth")
public class AuthController {

    private final AppUserRepository userRepository;
    private final PasswordEncoder passwordEncoder;

    public AuthController(AppUserRepository userRepository, PasswordEncoder passwordEncoder) {
        this.userRepository = userRepository;
        this.passwordEncoder = passwordEncoder;
    }

    @PostMapping("/register")
    public String register(@RequestBody AppUser user) {
        if (userRepository.findByUsername(user.getUsername()).isPresent()) {
            throw new RuntimeException("Użytkownik już istnieje!");
        }
        // Szyfrujemy hasło przed zapisem do bazy!
        user.setPassword(passwordEncoder.encode(user.getPassword()));
        userRepository.save(user);
        return "Zarejestrowano pomyślnie!";
    }
}