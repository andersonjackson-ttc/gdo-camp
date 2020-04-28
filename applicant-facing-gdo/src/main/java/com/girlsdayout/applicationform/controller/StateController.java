package com.girlsdayout.applicationform.controller;

import com.girlsdayout.applicationform.model.State;
import com.girlsdayout.applicationform.repository.StateRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;

@Controller
@RequestMapping(path = "/")
public class StateController {

    @Autowired
    StateRepository stateRepository;

    //method that returns all state entries in the database for the state dropdown
    @GetMapping(path = "states/all")
    public @ResponseBody
    Iterable<State> getAllStates() {
        //Returns a JSON or XML with the applicants
        return stateRepository.findAll();
    }
}
