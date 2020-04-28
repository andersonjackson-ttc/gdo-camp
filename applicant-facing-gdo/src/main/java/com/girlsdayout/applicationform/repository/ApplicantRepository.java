package com.girlsdayout.applicationform.repository;

import com.girlsdayout.applicationform.model.Applicant;
import org.springframework.data.repository.CrudRepository;

import java.util.Optional;

public interface ApplicantRepository extends CrudRepository<Applicant, Integer> {

    //specific CRUD method that returns an applicant object if found by the record ID
    Optional<Applicant> findByRecordId(String recordId);
}
