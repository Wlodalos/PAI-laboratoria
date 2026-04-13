package com.example.dziennik;

import org.springframework.data.jpa.repository.JpaRepository;
import java.util.List;

public interface WorkoutRepository extends JpaRepository<Workout, Long> {
    // Magiczna metoda Springa - sama wie, że ma szukać po loginie właściciela!
    List<Workout> findByAppUserUsername(String username);
}