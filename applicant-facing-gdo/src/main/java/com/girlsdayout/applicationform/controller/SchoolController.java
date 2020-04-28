package com.girlsdayout.applicationform.controller;

import com.girlsdayout.applicationform.model.School;
import com.girlsdayout.applicationform.repository.SchoolRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;

@Controller
@RequestMapping(path="/")
public class SchoolController {

    @Autowired
    SchoolRepository schoolRepository;

    //method that returns all school entries in the database for the school dropdown
    @GetMapping(path = "schools/all")
    public @ResponseBody
    Iterable<School> getAllSchools() {
        //Returns a JSON or XML with the applicants
        return schoolRepository.findAll();
    }
}
