package com.girlsdayout.applicationform;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

import javax.mail.MessagingException;

@Controller //Annotation makes the class a web controller capable of handling requests
@RequestMapping(path="/application") //specifies the URL path that the class will handle requests from
public class MainController {

    private Logger logger = LoggerFactory.getLogger(MainController.class);

    @Autowired
    private ApplicantRepository applicantRepository;

    @Autowired
    private NotificationService notificationService;

    //method that gets all information from user input and saves it to the database
    @PostMapping(path="/submit")
    public @ResponseBody String addNewApplicant (@RequestParam String fName, @RequestParam String lName,
                                        @RequestParam String address, @RequestParam String city,
                                        @RequestParam String state, @RequestParam String zipCode,
                                        @RequestParam String phoneNumber, @RequestParam String dateOfBirth,
                                        @RequestParam int age, @RequestParam String ethnicity,
                                        @RequestParam String allergies, @RequestParam String medications,
                                        @RequestParam String parentsCollege, @RequestParam String militaryRelatives,
                                        @RequestParam String fallSchool, @RequestParam String risingGradeLevel,
                                        @RequestParam String collegeOfInterest, @RequestParam String shirtSize,
                                        @RequestParam String parentFName, @RequestParam String parentLName,
                                        @RequestParam String parentEMail, @RequestParam String parentAddress,
                                        @RequestParam String parentCity, @RequestParam String parentState,
                                        @RequestParam String parentZipCode, @RequestParam String parentMobilePhone,
                                        @RequestParam String parentWorkPhone, @RequestParam String parentHomePhone,
                                        @RequestParam String otherParentFName, @RequestParam String otherParentLName,
                                        @RequestParam String contactName, @RequestParam String relationship,
                                        @RequestParam String contactAddress, @RequestParam String contactCity,
                                        @RequestParam String contactState, @RequestParam String contactZipCode,
                                        @RequestParam String contactMobilePhone, @RequestParam String contactWorkPhone,
                                        @RequestParam String contactInitials) {

        //creates new applicant object
        Applicant a = new Applicant();

        //setting all of the applicant's variables
        a.setfName(fName);
        a.setlName(lName);
        a.setAddress(address);
        a.setCity(city);
        a.setState(state);
        a.setZipCode(zipCode);
        a.setPhoneNumber(phoneNumber);
        a.setDateOfBirth(dateOfBirth);
        a.setAge(age);
        a.setEthnicity(ethnicity);
        a.setAllergies(allergies);
        a.setMedications(medications);
        a.setParentsCollege(parentsCollege);
        a.setMilitaryRelatives(militaryRelatives);
        a.setFallSchool(fallSchool);
        a.setRisingGradeLevel(risingGradeLevel);
        a.setCollegeOfInterest(collegeOfInterest);
        a.setShirtSize(shirtSize);

        //setting all the parent's variables
        a.setParentFName(parentFName);
        a.setParentLName(parentLName);
        a.setParentEMail(parentEMail);
        a.setParentAddress(parentAddress);
        a.setParentCity(parentCity);
        a.setParentState(parentState);
        a.setParentZipCode(parentZipCode);
        a.setParentMobilePhone(parentMobilePhone);
        a.setParentWorkPhone(parentWorkPhone);
        a.setParentHomePhone(parentHomePhone);
        a.setOtherParentFName(otherParentFName);
        a.setOtherParentLName(otherParentLName);

        //setting all the emergency contact variables
        a.setContactName(contactName);
        a.setRelationship(relationship);
        a.setContactAddress(contactAddress);
        a.setContactCity(contactCity);
        a.setContactState(contactState);
        a.setContactZipCode(contactZipCode);
        a.setContactMobilePhone(contactMobilePhone);
        a.setContactWorkPhone(contactWorkPhone);
        a.setContactInitials(contactInitials);

        //saves the applicant object to the database
        applicantRepository.save(a);

        //try-catch that sends confirmation e-mail to applicant after application data is sent to the db
        try {
            notificationService.sendNotification(a);
        }catch(MessagingException e){
            logger.info("error sending: " + e.getMessage());
            return "There was an error sending the confirmation e-mail";
        }

        //statement returned after object is saved to database
        return "The application has been submitted successfully. Please check your e-mail for confirmation.";

    }

    //method that returns all entries in the database
    @GetMapping(path = "/all")
    public @ResponseBody Iterable<Applicant> getAllApplicants() {
        //Returns a JSON or XML with the applicants
        return applicantRepository.findAll();
    }
}
