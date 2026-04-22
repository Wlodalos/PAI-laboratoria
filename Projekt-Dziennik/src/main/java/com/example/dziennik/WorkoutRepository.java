package com.example.dziennik;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import java.util.Optional;

public interface WorkoutRepository extends JpaRepository<Workout, Long> {
    Page<Workout> findByAppUser_Username(String username, Pageable pageable);
    
    Page<Workout> findByAppUser_UsernameAndExerciseNameContainingIgnoreCase(String username, String exerciseName, Pageable pageable);
}