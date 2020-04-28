package com.girlsdayout.applicationform.model;

import javax.persistence.*;
import java.time.LocalDate;
import java.time.Period;
import java.time.Year;




@Entity // Specifies that the class is an entity and is mapped to a DB table
@Table(name = "Applicant")
@SecondaryTables({ //annotation that is needed for data to be added to other tables in this class
        @SecondaryTable(name = "Parent", pkJoinColumns =  @PrimaryKeyJoinColumn(name = "id")),
        @SecondaryTable(name = "Emergency_Contact", pkJoinColumns = @PrimaryKeyJoinColumn(name = "id")),
        @SecondaryTable(name = "Waiver", pkJoinColumns = @PrimaryKeyJoinColumn(name = "id"))
})
public class Applicant {

    //@Id and @GeneratedValue set to AUTO makes the applicant ID set by the database, not by user input
    @Id
    @GeneratedValue(strategy=GenerationType.AUTO)
    @Column(name = "id")
    private Integer id;

    //Start of columns/variables for applicant table
    @Column(name = "First_Name")
    private String fName;

    @Column(name = "Last_Name")
    private String lName;

    @Column(name = "EMail")
    private String eMail;

    @Column(name = "Address")
    private String address;

    @Column(name = "City")
    private String city;

    @Column(name = "State")
    private String state;

    @Column(name = "Zip_Code")
    private String zipCode;

    @Column(name = "Phone_Number")
    private String phoneNumber;

    @Column(name = "Date_Of_Birth")
    private String dateOfBirth;

    @Column(name = "Age")
    private int age;

    @Column(name = "Allergies")
    private String allergies;

    @Column(name = "Medications")
    private String medications;

    @Column(name = "School_Attending_in_Fall")
    private String fallSchool;

    @Column(name = "Rising_Grade_Level")
    private String risingGradeLevel;

    @Column(name = "Parents_College")
    private String parentsCollege;

    @Column(name = "Relatives_in_Military")
    private String militaryRelatives;

    @Column(name = "Relatives_Military_Branch")
    private String militaryBranch;

    @Column(name = "College_of_Interest")
    private String collegeOfInterest;

    @Column(name = "Science_Interest")
    private String scienceInterest;

    @Column(name = "Technology_Interest")
    private String techInterest;

    @Column(name = "Engineering_Interest")
    private String engInterest;

    @Column(name = "Mathematics_Interest")
    private String mathInterest;

    @Column(name = "Shirt_Size")
    private String shirtSize;

    @Column(name = "Record_Id")
    private String recordId;

    @Column(name = "Waiver_Status")
    private String waiverStatus;

    @Column(name = "Application_Status")
    private String appStatus;

    @Column(name = "Year_Submitted")
    private String yearSubmitted;

    @Column(name = "Camp_Group")
    private String campGroup;

    @Column(name = "Denied_Reason")
    private String deniedReason;

    @Column(name = "Application_Notes")
    private String applicationNotes;
    //end of columns/variables for applicant table

    //Start of columns/variables for parent table
    @Column(name = "Primary_Parent_First_Name", table = "Parent")
    private String priParentFName;

    @Column(name = "Primary_Parent_Last_Name", table = "Parent")
    private String priParentLName;

    @Column(name = "Primary_Parent_EMail", table = "Parent")
    private String priParentEMail;

    @Column(name = "Primary_Parent_Address", table = "Parent")
    private String priParentAddress;

    @Column(name = "Primary_Parent_City", table = "Parent")
    private String priParentCity;

    @Column(name = "Primary_Parent_State", table = "Parent")
    private String priParentState;

    @Column(name = "Primary_Parent_Zip_Code", table = "Parent")
    private String priParentZipCode;

    @Column(name = "Primary_Parent_Primary_Phone", table = "Parent")
    private String priParentPrimaryPhone;

    @Column(name = "Primary_Parent_Alt_Phone", table = "Parent")
    private String priParentAltPhone;

    @Column(name = "Alt_Parent_First_Name", table = "Parent")
    private String altParentFName;

    @Column(name = "Alt_Parent_Last_Name", table = "Parent")
    private String altParentLName;

    @Column(name = "Alt_Parent_EMail", table = "Parent")
    private String altParentEMail;

    @Column(name = "Alt_Parent_Address", table = "Parent")
    private String altParentAddress;

    @Column(name = "Alt_Parent_City", table = "Parent")
    private String altParentCity;

    @Column(name = "Alt_Parent_State", table = "Parent")
    private String altParentState;

    @Column(name = "Alt_Parent_Zip_Code", table = "Parent")
    private String altParentZipCode;

    @Column(name = "Alt_Parent_Primary_Phone", table = "Parent")
    private String altParentPrimaryPhone;

    @Column(name = "Alt_Parent_Alt_Phone", table = "Parent")
    private String altParentAltPhone;
    //end of columns/variables for parent table

    //Start of columns/variables for emergency contact table
    @Column(name = "Contact_Name", table = "Emergency_Contact")
    private String contactName;

    @Column(name = "Contact_Relationship", table = "Emergency_Contact")
    private String relationship;

    @Column(name = "Contact_Address", table = "Emergency_Contact")
    private String contactAddress;

    @Column(name = "Contact_City", table = "Emergency_Contact")
    private String contactCity;

    @Column(name = "Contact_State", table = "Emergency_Contact")
    private String contactState;

    @Column(name = "Contact_Zip_Code", table = "Emergency_Contact")
    private String contactZipCode;

    @Column(name = "Contact_Primary_Phone", table = "Emergency_Contact")
    private String contactPrimaryPhone;

    @Column(name = "Contact_Alt_Phone", table = "Emergency_Contact")
    private String contactAltPhone;
    //end of columns/variables for emergency contact table

    //Start of columns/variables for waiver table
    @Column(name = "bosch_waiver_path", table = "Waiver")
    private String boschWaiver;

    @Column(name = "cofc_waiver_path", table = "Waiver")
    private String consentWaiver;

    @Column(name = "consent_waiver_path", table = "Waiver")
    private String cofcWaiver;
    //end of columns/variables for waiver table

    //getters and setters for all applicant variables
    public Integer getId() { return id; }

    public String getfName() { return fName; }

    public void setfName(String fName) {
        this.fName = fName;
    }

    public String getlName() {
        return lName;
    }

    public void setlName(String lName) {
        this.lName = lName;
    }

    public String getAddress() {
        return address;
    }

    public String getEmail() {
        return eMail;
    }

    public void setEmail(String eMail) {
        this.eMail = eMail;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public String getState() { return state; }

    public void setState(String state) { this.state = state; }

    public String getZipCode() {
        return zipCode;
    }

    public void setZipCode(String zipCode) {
        this.zipCode = zipCode;
    }

    public String getPhoneNumber() {
        return phoneNumber;
    }

    public void setPhoneNumber(String phoneNumber) {
        this.phoneNumber = phoneNumber;
    }

    public String getDateOfBirth() {
        return dateOfBirth;
    }

    public void setDateOfBirth(String dateOfBirth) {
        this.dateOfBirth = dateOfBirth;
    }

    public int getAge() { return age; }

    //calculates age based on date of birth
    public void setAge(String dateOfBirth) {

        //gets todays date and converts string DoB to localDate DoB
        LocalDate today = LocalDate.now();
        LocalDate birthday = LocalDate.parse(dateOfBirth);

        //period object that gets the difference between dob and day of user application (today)
        Period p = Period.between(birthday, today);

        //this applicant's age is the difference of years
        this.age = p.getYears();
    }

    public String getAllergies() {
        return allergies;
    }

    public void setAllergies(String allergies) {
        this.allergies = allergies;
    }

    public String getMedications() {
        return medications;
    }

    public void setMedications(String medications) {
        this.medications = medications;
    }

    public String getParentsCollege() {
        return parentsCollege;
    }

    public void setParentsCollege(String parentsCollege) {
        this.parentsCollege = parentsCollege;
    }

    public String getMilitaryRelatives() {
        return militaryRelatives;
    }

    public void setMilitaryRelatives(String militaryRelatives) {
        this.militaryRelatives = militaryRelatives;
    }

    public String getMilitaryBranch() {
        return militaryBranch;
    }

    public void setMilitaryBranch(String militaryBranch) {
        this.militaryBranch = militaryBranch;
    }

    public String getFallSchool() {
        return fallSchool;
    }

    public void setFallSchool(String fallSchool) {
        this.fallSchool = fallSchool;
    }

    public String getRisingGradeLevel() {
        return risingGradeLevel;
    }

    public void setRisingGradeLevel(String risingGradeLevel) {
        this.risingGradeLevel = risingGradeLevel;
    }

    public String getCollegeOfInterest() {
        return collegeOfInterest;
    }

    public void setCollegeOfInterest(String collegeOfInterest) {
        this.collegeOfInterest = collegeOfInterest;
    }

    public String getScienceInterest() {
        return scienceInterest;
    }

    public void setScienceInterest(String scienceInterest) {
        this.scienceInterest = scienceInterest;
    }

    public String getTechInterest() {
        return techInterest;
    }

    public void setTechInterest(String techInterest) {
        this.techInterest = techInterest;
    }

    public String getEngInterest() {
        return engInterest;
    }

    public void setEngInterest(String engInterest) {
        this.engInterest = engInterest;
    }

    public String getMathInterest() {
        return mathInterest;
    }

    public void setMathInterest(String mathInterest) {
        this.mathInterest = mathInterest;
    }

    public String getShirtSize() {
        return shirtSize;
    }

    public void setShirtSize(String shirtSize) {
        this.shirtSize = shirtSize;
    }

    public String getRecordId() {
        return recordId;
    }

    //gets a unique record ID and sets it to this applicant's record ID
    public void setRecordId(Iterable<Applicant> allApplicants) {

        //assigns passed collection of applicant objects to local Iterable
        Iterable<Applicant> applicants = allApplicants;

        //calls method that generates a random ID and assigns it to temp ID
        String tempId = generateRecordId();

        //flag set at 0, used when checking for collision
        int flag = 0;

        //collision set to true, used when checking for collision
        boolean collision = true;

        /*
         * while collision is present, walk through applicants comparing tempId with all recordIds.
         * IF match is found, flag is set to -1.
         * IF flag is -1, generateRecordId is called again to assign a new ID to tempId.
         *      Flag is then set to 0 again for the next loop
         * IF flag is  0 (else), collision is set to false, which will end the loop.
         *      tempId is then assigned to this.recordId
         */
        while (collision){
            for (Applicant a : applicants){
                if (tempId.equals(a.recordId)){
                    flag = -1;
                }
            }
            if(flag == -1){
                tempId = generateRecordId();
                flag = 0;
            }
            else {
                collision = false;
            }
        }

        this.recordId = tempId;
    }

    //method that is called by setRecordId to generate a random 8-digit ID.
    public String generateRecordId() {
        String characters = "01234567890abcdefghijklmnopqrstuvxyz";
        StringBuilder sb = new StringBuilder(8);

        //grabs a random character from characters string 8 times.
        for(int i = 0; i < 8; i++){
            int index = (int)(characters.length() * Math.random());
            sb.append(characters.charAt(index));
        }

        return sb.toString();
    }

    public String getWaiverStatus() {return waiverStatus;}

    public void setWaiverStatus(String status) {
        this.waiverStatus = status;
    }

    public String getAppStatus() {
        return appStatus;
    }

    // method that sets appStatus to pending or Waitlist depending on the amount of previous applicants
    public void setAppStatus(Iterable<Applicant> allApplicants) {
        //assigns passed collection of applicant objects to applicants Iterable
        Iterable<Applicant> applicants = allApplicants;

        //local variables
        String status;
        int count = 0;
        final int MAX_CAMPERS = 125;
        boolean waitList = false;

        //getting current year
        Year year = Year.now();
        String thisYear = year.toString();

        //walks the collection of applicants
        for (Applicant a : applicants){
            /*
             * for each applicant object, count how many applications are Pending or Approved (i.e. NOT Denied or cancelled)
             * It will also only count the applicants in database that have yearSubmitted as current year.
             */
            if ((a.appStatus.equals("Pending") || a.appStatus.equals("Approved")) && a.yearSubmitted.equals(thisYear)){
                count++;
            }

            /*
             * checks if there is someone already on the waitlist, if so, waitlist is changed to true
             * This is necessary in case an applicant's status is changed to denied/withdrawn/cancelled,
             * but a waitlist applicant has yet to be changed to pending/approved. Without this, a new
             * applicant could be set to pending while there are older applicants on waitlist. This will not
             * be necessary if the admin side is coded to instantly grab the first person on waitlist and change
             * them to pending, when an applicant is denied/withdrawn/cancelled
             */
            if (a.appStatus.equals("Waitlist")){
                waitList = true;
            }
        }

        //if there are 125+ applicants, or if there is already an applicant on waitlist, status is set to "Waitlist"
        if (count >= MAX_CAMPERS || waitList){
            status = "Waitlist";
        }
        //if there are less than 125 applicants and no waitlist, status is set to "Pending"
        else {
            status = "Pending";
        }

        // status assigned to this object's appStatus
        this.appStatus = status;
    }

    public String getCampGroup() {
        return campGroup;
    }

    public void setCampGroup() {
        this.campGroup = null;
    }

    public String getDeniedReason() {
        return deniedReason;
    }

    public void setDeniedReason() {
        this.deniedReason = null;
    }

    public String getApplicationNotes() {
        return applicationNotes;
    }

    public void setApplicationNotes() {
        this.applicationNotes = null;
    }

    public String getYearSubmitted() {
        return yearSubmitted;
    }

    public void setYearSubmitted() {
        //gets current year in year class and converts to string, then assigned to this.yearsubmitted
        Year year = Year.now();
        String yearString = year.toString();

        this.yearSubmitted = yearString;
    }

    //end of getters and setters for applicant variables

    //getters and setters for parent variables

    public String getPriParentFName() {
        return priParentFName;
    }

    public void setPriParentFName(String priParentFName) {
        this.priParentFName = priParentFName;
    }

    public String getPriParentLName() {
        return priParentLName;
    }

    public void setPriParentLName(String priParentLName) {
        this.priParentLName = priParentLName;
    }

    public String getPriParentEMail() {
        return priParentEMail;
    }

    public void setPriParentEMail(String priParentEMail) {
        this.priParentEMail = priParentEMail;
    }

    public String getPriParentAddress() {
        return priParentAddress;
    }

    public void setPriParentAddress(String priParentAddress) {
        this.priParentAddress = priParentAddress;
    }

    public String getPriParentCity() {
        return priParentCity;
    }

    public void setPriParentCity(String priParentCity) {
        this.priParentCity = priParentCity;
    }

    public String getPriParentState() {
        return priParentState;
    }

    public void setPriParentState(String priParentState) {
        this.priParentState = priParentState;
    }

    public String getPriParentZipCode() {
        return priParentZipCode;
    }

    public void setPriParentZipCode(String priParentZipCode) {
        this.priParentZipCode = priParentZipCode;
    }

    public String getPriParentPrimaryPhone() {
        return priParentPrimaryPhone;
    }

    public void setPriParentPrimaryPhone(String priParentPrimaryPhone) {
        this.priParentPrimaryPhone = priParentPrimaryPhone;
    }

    public String getPriParentAltPhone() {
        return priParentAltPhone;
    }

    public void setPriParentAltPhone(String priParentAltPhone) {
        this.priParentAltPhone = priParentAltPhone;
    }

    public String getAltParentFName() {
        return altParentFName;
    }

    public void setAltParentFName(String altParentFName) {
        this.altParentFName = altParentFName;
    }

    public String getAltParentLName() {
        return altParentLName;
    }

    public void setAltParentLName(String altParentLName) {
        this.altParentLName = altParentLName;
    }

    public String getAltParentEMail() {
        return altParentEMail;
    }

    public void setAltParentEMail(String altParentEMail) {
        this.altParentEMail = altParentEMail;
    }

    public String getAltParentAddress() {
        return altParentAddress;
    }

    public void setAltParentAddress(String altParentAddress) {
        this.altParentAddress = altParentAddress;
    }

    public String getAltParentCity() {
        return altParentCity;
    }

    public void setAltParentCity(String altParentCity) {
        this.altParentCity = altParentCity;
    }

    public String getAltParentState() {
        return altParentState;
    }

    public void setAltParentState(String altParentState) {
        this.altParentState = altParentState;
    }

    public String getAltParentZipCode() {
        return altParentZipCode;
    }

    public void setAltParentZipCode(String altParentZipCode) {
        this.altParentZipCode = altParentZipCode;
    }

    public String getAltParentPrimaryPhone() {
        return altParentPrimaryPhone;
    }

    public void setAltParentPrimaryPhone(String altParentPrimaryPhone) {
        this.altParentPrimaryPhone = altParentPrimaryPhone;
    }

    public String getAltParentAltPhone() {
        return altParentAltPhone;
    }

    public void setAltParentAltPhone(String altParentAltPhone) {
        this.altParentAltPhone = altParentAltPhone;
    }

    //end of getters/setters for parent variables

    //start of getters setters for emergency contact variables

    public String getContactName() {
        return contactName;
    }

    public void setContactName(String contactName) {
        this.contactName = contactName;
    }

    public String getRelationship() {
        return relationship;
    }

    public void setRelationship(String relationship) {
        this.relationship = relationship;
    }

    public String getContactAddress() {
        return contactAddress;
    }

    public void setContactAddress(String contactAddress) {
        this.contactAddress = contactAddress;
    }

    public String getContactCity() {
        return contactCity;
    }

    public void setContactCity(String contactCity) {
        this.contactCity = contactCity;
    }

    public String getContactState() {
        return contactState;
    }

    public void setContactState(String contactState) {
        this.contactState = contactState;
    }

    public String getContactZipCode() {
        return contactZipCode;
    }

    public void setContactZipCode(String contactZipCode) {
        this.contactZipCode = contactZipCode;
    }

    public String getContactPrimaryPhone() {
        return contactPrimaryPhone;
    }

    public void setContactPrimaryPhone(String contactPrimaryPhone) {
        this.contactPrimaryPhone = contactPrimaryPhone;
    }

    public String getContactAltPhone() {
        return contactAltPhone;
    }

    public void setContactAltPhone(String contactAltPhone) {
        this.contactAltPhone = contactAltPhone;
    }

    //end of getters/setters for emergency contact variables

    //start of getters/setters for waiver table

    public String getBoschWaiver() {
        return boschWaiver;
    }

    public void setBoschWaiver(String boschWaiver) {
        this.boschWaiver = boschWaiver;
    }

    public String getConsentWaiver() {
        return consentWaiver;
    }

    public void setConsentWaiver(String consentWaiver) {
        this.consentWaiver = consentWaiver;
    }

    public String getCofcWaiver() {
        return cofcWaiver;
    }

    public void setCofcWaiver(String cofcWaiver) {
        this.cofcWaiver = cofcWaiver;
    }


}