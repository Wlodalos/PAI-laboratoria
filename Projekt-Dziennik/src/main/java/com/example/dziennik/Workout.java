package com.example.dziennik;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import com.fasterxml.jackson.annotation.JsonIgnore;

@Entity
public class Workout {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    
    private String exerciseName;
    private int weight;
    private int repetitions;

    // Relacja: Wiele treningów należy do jednego użytkownika
    @JsonIgnore
    @ManyToOne
    @JoinColumn(name = "user_id", nullable = false)
    private AppUser appUser;

    // DODAJ TEŻ GETTER I SETTER NA SAMYM DOLE PLIKU:
    public AppUser getAppUser() { return appUser; }
    public void setAppUser(AppUser appUser) { this.appUser = appUser; }

    public Workout() {}

    public Workout(String exerciseName, int weight, int repetitions) {
        this.exerciseName = exerciseName;
        this.weight = weight;
        this.repetitions = repetitions;
    }

    public Long getId() { return id; }
    public void setId(Long id) { this.id = id; }

    public String getExerciseName() { return exerciseName; }
    public void setExerciseName(String exerciseName) { this.exerciseName = exerciseName; }

    public int getWeight() { return weight; }
    public void setWeight(int weight) { this.weight = weight; }

    public int getRepetitions() { return repetitions; }
    public void setRepetitions(int repetitions) { this.repetitions = repetitions; }
}