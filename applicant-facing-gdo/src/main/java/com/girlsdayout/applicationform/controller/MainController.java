package com.girlsdayout.applicationform.controller;

import com.girlsdayout.applicationform.model.Applicant;
import com.girlsdayout.applicationform.repository.AdminRepository;
import com.girlsdayout.applicationform.repository.ApplicantRepository;
import com.girlsdayout.applicationform.service.NotificationService;
import com.girlsdayout.applicationform.service.WaiverUploadService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.multipart.MultipartFile;

import javax.mail.MessagingException;
import java.io.IOException;
import java.util.Optional;

@Controller //Annotation makes the class a web controller capable of handling requests
@RequestMapping(path="/") //specifies the URL path that the class will handle requests from
public class MainController {

    @Autowired
    private ApplicantRepository applicantRepository;

    @Autowired
    AdminRepository adminRepository;

    @Autowired
    private NotificationService notificationService;

    @Autowired
    private WaiverUploadService waiverService;

    //method that gets all information from user input and saves it to the database
    @PostMapping(path="application/submit")
    public String addNewApplicant (@RequestParam String lName, @RequestParam String fName,
                                        @RequestParam String address, @RequestParam String city,
                                        @RequestParam String state, @RequestParam String zipCode,
                                        @RequestParam String phoneNumber, @RequestParam String dateOfBirth,
                                        @RequestParam String email, @RequestParam(value = "checkbox[]", required = false)int[] checkboxValue,
                                        @RequestParam String allergies, @RequestParam String medications,
                                        @RequestParam(required = false) String parentsCollege, @RequestParam(required = false) String militaryRelatives,
                                        @RequestParam(required = false) String militaryBranch, @RequestParam(required = false) String writeInSchool,
                                        @RequestParam(required = false) String eduLevel,
                                        @RequestParam String fallSchool, @RequestParam String risingGradeLevel,
                                        @RequestParam String collegeOfInterest, @RequestParam String shirtSize,
                                        @RequestParam String altParentFName, @RequestParam String altParentLName,
                                        @RequestParam String altParentEMail, @RequestParam String altParentAddress,
                                        @RequestParam String altParentCity, @RequestParam String altParentState,
                                        @RequestParam String altParentZipCode, @RequestParam String altParentPrimaryPhone,
                                        @RequestParam String altParentAltPhone, @RequestParam String priParentFName,
                                        @RequestParam String priParentEMail, @RequestParam String priParentAddress,
                                        @RequestParam String priParentCity, @RequestParam String priParentState,
                                        @RequestParam String priParentZipCode, @RequestParam String priParentPrimaryPhone,
                                        @RequestParam String priParentAltPhone, @RequestParam String priParentLName,
                                        @RequestParam String contactName, @RequestParam String relationship,
                                        @RequestParam String contactAddress, @RequestParam String contactCity,
                                        @RequestParam String contactState, @RequestParam String contactZipCode,
                                        @RequestParam String contactPrimaryPhone, @RequestParam String contactAltPhone) throws MessagingException {

        //creates new applicant object
        Applicant a = new Applicant();

        //setting all of the applicant's variables
        a.setfName(fName);
        a.setlName(lName);
        a.setEmail(email);
        a.setAddress(address);
        a.setCity(city);
        a.setState(state);
        a.setZipCode(zipCode);
        a.setPhoneNumber(phoneNumber);
        a.setDateOfBirth(dateOfBirth);
        a.setAge(dateOfBirth);
        a.setAllergies(allergies);
        a.setMedications(medications);

        if (parentsCollege != null){
            if (parentsCollege.equals("Yes")){
                a.setParentsCollege(parentsCollege + ": " + eduLevel);
            }
            else{
                a.setParentsCollege(parentsCollege);
            }
        }

        a.setMilitaryRelatives(militaryRelatives);
        a.setMilitaryBranch(militaryBranch);

        //current value of school when "other" is chosen in the school dropdown. Passed through fallSchool.
        String otherSchool = "Other (list in details column)";

        /*if passed fallSchool value = otherSchool AKA user chose other for school dropdown:
        *   change fallSchool to "Other: x" where x = writeInSchool (value entered in other school textbox).
        */
        if (fallSchool.equals(otherSchool)) {
            fallSchool = "Other: " + writeInSchool;
        }

        a.setFallSchool(fallSchool);
        a.setRisingGradeLevel(risingGradeLevel);
        a.setCollegeOfInterest(collegeOfInterest);
        a.setShirtSize(shirtSize);
        a.setRecordId(applicantRepository.findAll());
        a.setWaiverStatus("Not Submitted");
        a.setAppStatus(applicantRepository.findAll());
        a.setCampGroup();
        a.setDeniedReason();
        a.setApplicationNotes();
        a.setYearSubmitted();

        //setting applicant interest variables
        String scienceInt = "No";
        String techInt = "No";
        String engInt = "No";
        String mathInt = "No";

        if (checkboxValue != null){
            for (int i = 0; i < checkboxValue.length; i++){
                switch (checkboxValue[i]){
                    case 1:
                        scienceInt = "Yes";
                        break;
                    case 2:
                        techInt = "Yes";
                        break;
                    case 3:
                        engInt = "Yes";
                        break;
                    case 4:
                        mathInt = "Yes";
                        break;
                }
            }
        }


        a.setScienceInterest(scienceInt);
        a.setTechInterest(techInt);
        a.setEngInterest(engInt);
        a.setMathInterest(mathInt);
        //end of all applicant variables

        //setting all the parent's variables
        a.setPriParentFName(priParentFName);
        a.setPriParentLName(priParentLName);
        a.setPriParentEMail(priParentEMail);
        a.setPriParentAddress(priParentAddress);
        a.setPriParentCity(priParentCity);
        a.setPriParentState(priParentState);
        a.setPriParentZipCode(priParentZipCode);
        a.setPriParentPrimaryPhone(priParentPrimaryPhone);
        a.setPriParentAltPhone(priParentAltPhone);
        a.setAltParentFName(altParentFName);
        a.setAltParentLName(altParentLName);
        a.setAltParentEMail(altParentEMail);
        a.setAltParentAddress(altParentAddress);
        a.setAltParentCity(altParentCity);
        a.setAltParentState(altParentState);
        a.setAltParentZipCode(altParentZipCode);
        a.setAltParentPrimaryPhone(altParentPrimaryPhone);
        a.setAltParentAltPhone(altParentAltPhone);
        //end of all parent variables

        //setting all the emergency contact variables
        a.setContactName(contactName);
        a.setRelationship(relationship);
        a.setContactAddress(contactAddress);
        a.setContactCity(contactCity);
        a.setContactState(contactState);
        a.setContactZipCode(contactZipCode);
        a.setContactPrimaryPhone(contactPrimaryPhone);
        a.setContactAltPhone(contactAltPhone);
        //end of em contact variables

        //setting waiver variables to empty strings
        a.setBoschWaiver("");
        a.setConsentWaiver("");
        a.setCofcWaiver("");

        //saves the applicant object to the database
        applicantRepository.save(a);

        // sends confirmation e-mail to applicant after application data is sent to the db
        notificationService.emailApplicant(a);

        //passes all admins, type string, and the applicant object to the method that e-mails approvers of a new application
        notificationService.emailApprovers(adminRepository.findAll(), "application", a);
 
        //the return statement redirects to the application/submit/recordID page.
        return "redirect:/application/submit/" + a.getRecordId();

    }

    //Prevents a 405 whitelabel error page when users type in application/submit instead of submitting application to get there
    @GetMapping(path = { "application/submit", "contactus/send", "waiver/{id}/submit"})
    public String replacingError() {return "405.html";}

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

    /*
     * method that uploads the waivers to the desired directory on the server. Method also saves path files of
     * saved waivers to the database. Also checks the content type of files uploaded, verifying that they are pdf
     * or image file. If waiver upload is successful, e-mail will be sent to approvers that new waivers were uploaded.
     */
    @PostMapping(path= "waiver/{id}/submit")
    public String multiUpload(@RequestParam("boschWaiver") MultipartFile boschWaiver, @RequestParam("consentWaiver") MultipartFile consentWaiver,
                              @RequestParam("cofcWaiver") MultipartFile cofcWaiver, @PathVariable("id") String id) throws IOException, MessagingException {
        //recordID = id passed in the path from post request
        String recordId = id;

        //file path of desired directory where waivers will be uploaded
        String filePath = "/Users/MatthewHunt/Documents/Trident Technical College/Spring 2020/Senior Capstone/WaiverFiles/";

        //gets applicant object that matches the record ID
        Optional<Applicant> applicant = applicantRepository.findByRecordId(recordId);
        Applicant a = applicant.get();

        //getting the file types of each file and assigning to string variables
        String boschType = boschWaiver.getContentType();
        String consentType = consentWaiver.getContentType();
        String cofcType = cofcWaiver.getContentType();

        //if all three files match an accepted file type, continue with uploading the waiver
        if ((boschType.equals("image/jpeg") || boschType.equals("image/png") || boschType.equals("image/jpg") || boschType.equals("image/svg") || boschType.equals("application/pdf"))
                & (consentType.equals("image/jpeg") || consentType.equals("image/png") || consentType.equals("image/jpg") || consentType.equals("image/svg") || consentType.equals("application/pdf"))
                & (cofcType.equals("image/jpeg") || cofcType.equals("image/png") || cofcType.equals("image/jpg") || cofcType.equals("image/svg") || cofcType.equals("application/pdf")))
        {
            //upload waiver through waiverService
            waiverService.uploadWaiver(boschWaiver, filePath , a.getRecordId(), "-BoschWaiver");
            waiverService.uploadWaiver(consentWaiver, filePath , a.getRecordId(), "-ConsentWaiver");
            waiverService.uploadWaiver(cofcWaiver, filePath , a.getRecordId(), "-CofCWaiver");

            //change app_status to Pending and inserts the file paths of the uploaded waivers to the waiver table
            a.setWaiverStatus("Submitted");
            a.setBoschWaiver(filePath + a.getRecordId() + "-BoschWaiver");
            a.setConsentWaiver(filePath + a.getRecordId() + "-ConsentWaiver");
            a.setCofcWaiver(filePath + a.getRecordId() + "-CofCWaiver");

            //sends an e-mail to the approvers that waivers were uploaded
            notificationService.emailApprovers(adminRepository.findAll(), "Waiver", a);

            //saves the changes to the applicant object
            applicantRepository.save(a);

            //returns the submitted waiver page
            return "waiversubmit.html";
        }
        /*
         * ELSE - somehow an unaccepted file type was submitted by user.
         * Not uploaded or inserted to DB. Waiver error page returned.
         */
        else{
            return "waivererror.html";
        }
    }

    //method that takes the information sent in the contact us form and e-mails it to the GDO contact e-mail.
    @PostMapping(path="contactus/send")
    public String sendContactMessage(@RequestParam String name, @RequestParam String email, @RequestParam String message){

        //passing user input values from contact us form to notification service to send out email
        notificationService.contactEmail(name, email, message);

        //returns simple page that tells the user the message has been sent.
        return "messagesent.html";
    }
}
