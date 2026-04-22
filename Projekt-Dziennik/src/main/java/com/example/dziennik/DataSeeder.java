package com.example.dziennik;

import org.springframework.boot.CommandLineRunner;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Component;

@Component
public class DataSeeder implements CommandLineRunner {

    private final AppUserRepository userRepository;
    private final RoleRepository roleRepository;
    private final PasswordEncoder passwordEncoder;

    public DataSeeder(AppUserRepository userRepository, RoleRepository roleRepository, PasswordEncoder passwordEncoder) {
        this.userRepository = userRepository;
        this.roleRepository = roleRepository;
        this.passwordEncoder = passwordEncoder;
    }

    @Override
    public void run(String... args) {
        Role adminR = roleRepository.findByName("ADMIN").orElseGet(() -> roleRepository.save(new Role("ADMIN")));
        Role trenerR = roleRepository.findByName("TRENER").orElseGet(() -> roleRepository.save(new Role("TRENER")));
        Role userR = roleRepository.findByName("USER").orElseGet(() -> roleRepository.save(new Role("USER")));

        if (userRepository.findByUsername("Bartek").isEmpty()) {
            AppUser bartek = new AppUser();
            bartek.setUsername("Bartek");
            bartek.setPassword(passwordEncoder.encode("superhaslo123"));
            bartek.getRoles().add(adminR);
            bartek.getRoles().add(userR);
            userRepository.save(bartek);
            System.out.println(">>> Seed: Utworzono użytkownika Bartek (ADMIN)");
        }

        if (userRepository.findByUsername("Trener1").isEmpty()) {
            AppUser trener = new AppUser();
            trener.setUsername("Trener1");
            trener.setPassword(passwordEncoder.encode("haslo123"));
            trener.getRoles().add(trenerR);
            userRepository.save(trener);
            System.out.println(">>> Seed: Utworzono użytkownika Trener1 (TRENER)");
        }

        if (userRepository.findByUsername("User1").isEmpty()) {
            AppUser normalUser = new AppUser();
            normalUser.setUsername("User1");
            normalUser.setPassword(passwordEncoder.encode("haslo123"));
            normalUser.getRoles().add(userR);
            userRepository.save(normalUser);
            System.out.println(">>> Seed: Utworzono użytkownika User1 (USER)");
        }
    }
}