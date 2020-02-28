package com.girlsdayout.applicationform;

import com.girlsdayout.applicationform.Applicant;
import org.springframework.data.repository.CrudRepository;

//interface class used by spring boot to input data from MainController into database
public interface ApplicantRepository extends CrudRepository<Applicant, Integer> {

}
