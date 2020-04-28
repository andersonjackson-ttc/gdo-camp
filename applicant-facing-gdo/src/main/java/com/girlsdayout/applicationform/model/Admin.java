package com.girlsdayout.applicationform.model;

import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name = "Admin")
public class Admin {

    //variables for admin table, with getters, no setters

    @Id
    private int id;

    private String name;
    private String email;
    private String job;

    public int getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public String getEmail() {
        return email;
    }

    public String getJob() {
        return job;
    }
}
