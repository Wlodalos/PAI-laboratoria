package com.example.dziennik; // Upewnij się, że masz tu swoją nazwę paczki!

import org.springframework.data.jpa.repository.JpaRepository;
import java.util.Optional;

public interface AppUserRepository extends JpaRepository<AppUser, Long> {
    // Wyszukiwanie użytkownika po loginie (potrzebne do logowania)
    Optional<AppUser> findByUsername(String username);
}