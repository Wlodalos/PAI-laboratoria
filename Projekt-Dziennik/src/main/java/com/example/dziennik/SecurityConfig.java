package com.example.dziennik;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.security.config.Customizer;

@Configuration
@EnableWebSecurity
public class SecurityConfig {

    @Bean
    public SecurityFilterChain filterChain(HttpSecurity http) throws Exception {
        http
            .csrf(csrf -> csrf.disable()) // Wyłączamy ochronę CSRF dla uproszczenia naszego API
            .authorizeHttpRequests(auth -> auth
                .requestMatchers("/", "/index.html", "/api/auth/register").permitAll() // Te linki nie wymagają hasła
                .anyRequest().authenticated() // Każdy inny link (np. /treningi) blokujemy kłódką
            )
            .httpBasic(Customizer.withDefaults()); // Włączamy standardowe okienko logowania
        
        return http.build();
    }

    @Bean
    public PasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder(); // Zaawansowany algorytm szyfrujący
    }
}