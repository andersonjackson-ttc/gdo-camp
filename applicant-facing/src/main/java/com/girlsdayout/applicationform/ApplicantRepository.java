package com.girlsdayout.applicationform;

import com.girlsdayout.applicationform.Applicant;
import org.springframework.data.repository.CrudRepository;

import java.util.Optional;

//interface class used by spring boot to input data from MainController into database
public interface ApplicantRepository extends CrudRepository<Applicant, Integer> {

    //specific CRUD method that returns an applicant object if found by the record ID
    Optional<Applicant> findByRecordId(String recordId);
}
