package com.girlsdayout.applicationform.model;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name = "states")
public class State {

    //variables for states table, with getters, no setters

    @Id
    @Column(name = "stateID")
    private int stateId;

    @Column(name = "state_name")
    private String stateName;

    @Column(name = "state_abbr")
    private String stateAbbr;

    public int getStateId() {
        return stateId;
    }

    public String getStateName() {
        return stateName;
    }

    public String getStateAbbr() {
        return stateAbbr;
    }
}
