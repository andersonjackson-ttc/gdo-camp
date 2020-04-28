package com.girlsdayout.applicationform.model;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name = "schools")
public class School {

    //variables for schools table, with getters, no setters needed

    @Id
    @Column(name = "schoolID")
    private int schoolID;

    @Column(name = "school_name")
    private String schoolName;

    public int getSchoolID() {
        return schoolID;
    }

    public String getSchoolName() {
        return schoolName;
    }
}
