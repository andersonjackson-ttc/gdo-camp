package com.girlsdayout.applicationform;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

import javax.mail.MessagingException;
import java.util.Optional;

@Controller //Annotation makes the class a web controller capable of handling requests
@RequestMapping(path="/") //specifies the URL path that the class will handle requests from
public class MainController {

    private Logger logger = LoggerFactory.getLogger(MainController.class);

    @Autowired
    private ApplicantRepository applicantRepository;

    @Autowired
    private NotificationService notificationService;

    //method that gets all information from user input and saves it to the database
    @PostMapping(path="application/submit")
    public String addNewApplicant (@RequestParam String lName, @RequestParam String fName,
                                        @RequestParam String address, @RequestParam String city,
                                        @RequestParam String state, @RequestParam String zipCode,
                                        @RequestParam String phoneNumber, @RequestParam String dateOfBirth,
                                        @RequestParam String ethnicity,
                                        @RequestParam String allergies, @RequestParam String medications,
                                        @RequestParam String parentsCollege, @RequestParam String militaryRelatives,
                                        @RequestParam String fallSchool, @RequestParam String risingGradeLevel,
                                        @RequestParam String collegeOfInterest, @RequestParam String shirtSize,
                                        @RequestParam String parentFName, @RequestParam String parentLName,
                                        @RequestParam String parentEMail, @RequestParam String parentAddress,
                                        @RequestParam String parentCity, @RequestParam String parentState,
                                        @RequestParam String parentZipCode, @RequestParam String parentMobilePhone,
                                        @RequestParam String parentWorkPhone,
                                        @RequestParam String otherParentFName, @RequestParam String otherParentLName,
                                        @RequestParam String contactName, @RequestParam String relationship,
                                        @RequestParam String contactAddress, @RequestParam String contactCity,
                                        @RequestParam String contactState, @RequestParam String contactZipCode,
                                        @RequestParam String contactMobilePhone, @RequestParam String contactWorkPhone) {

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
        a.setAge();
        a.setEthnicity(ethnicity);
        a.setAllergies(allergies);
        a.setMedications(medications);
        a.setParentsCollege(parentsCollege);
        a.setMilitaryRelatives(militaryRelatives);
        a.setFallSchool(fallSchool);
        a.setRisingGradeLevel(risingGradeLevel);
        a.setCollegeOfInterest(collegeOfInterest);
        a.setShirtSize(shirtSize);
        a.setRecordId();
        a.setWaiverStatus();
        a.setAppStatus();

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

        //saves the applicant object to the database
        applicantRepository.save(a);

        //try-catch that sends confirmation e-mail to applicant after application data is sent to the db
        try {
            notificationService.sendNotification(a);
        }catch(MessagingException e){
            logger.info("error sending: " + e.getMessage());
            return "There was an error sending the confirmation e-mail";
        }

        //the return statement redirects to the application/submit/recordID page.
        return "redirect:/application/submit/" + a.getRecordId();

    }

    //method that returns all entries in the database
    @GetMapping(path = "application/all")
    public @ResponseBody Iterable<Applicant> getAllApplicants() {
        //Returns a JSON or XML with the applicants
        return applicantRepository.findAll();
    }

    //this Get method returns json of the applicant, found by record ID, which is fetched by the javascript pages that needs it
    @GetMapping(path = "applicant/{id}")
    public @ResponseBody
    Optional<Applicant> getApplicant(@PathVariable String id) {
        return applicantRepository.findByRecordId(id);
    }

    //returns home.html for "/" path
    @RequestMapping(path = "")
    public String home() {return "home.html";}

    //returns application.html for /application path
    @RequestMapping(path = "application")
    public String application() {return "application.html";}

    //returns photogallery.html for /photogallery path
    @RequestMapping(path = "photogallery")
    public String photoGallery() {return "photogallery.html";}

    //returns contact.html for /contactus path
    @RequestMapping(path = "contactus")
    public String contactUs() {return "contact.html";}

    //returns faq.html for /faqs path
    @RequestMapping(path = "faqs")
    public String faq() {return "faq.html";}

    //returns waiver.html for /waiver/{id} path where {id} is recordID
    @RequestMapping(path = "waiver/{id}")
    public String waiver() {
        return "waiver.html";
    }

    //returns appstatus.html for /application/status/{id} path where {id} is recordID
    @RequestMapping(path = "application/status/{id}")
    public String status() {return "appstatus.html";}

    //returns submit.html for //application/submit/{id} path where {id} is recordID
    @RequestMapping(path = "application/submit/{id}")
    public String submit() {return "submit.html";}
}
