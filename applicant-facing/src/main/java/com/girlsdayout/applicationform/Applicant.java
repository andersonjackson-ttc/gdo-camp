package com.girlsdayout.applicationform;

import javax.persistence.*;

@Entity // Specifies that the class is an entity and is mapped to a DB table
@Table(name = "Applicant")
@SecondaryTables({ //annotation that is needed for data to be added to other tables in this class
        @SecondaryTable(name = "Parent", pkJoinColumns =  @PrimaryKeyJoinColumn(name = "id")),
        @SecondaryTable(name = "Emergency_Contact", pkJoinColumns = @PrimaryKeyJoinColumn(name = "id"))
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

    @Column(name = "Ethnicity")
    private String ethnicity;

    @Column(name = "Allergies")
    private String allergies;

    @Column(name = "Medications")
    private String medications;

    @Column(name = "Parents_College")
    private String parentsCollege;

    @Column(name = "Relatives_in_Military")
    private String militaryRelatives;

    @Column(name = "School_Attending_in_Fall")
    private String fallSchool;

    @Column(name = "Rising_Grade_Level")
    private String risingGradeLevel;

    @Column(name = "College_of_Interest")
    private String collegeOfInterest;

    @Column(name = "Shirt_Size")
    private String shirtSize;

    @Column(name = "Record_Id")
    private String recordId;

    @Column(name = "Waiver_Status")
    private String waiverStatus;

    @Column(name = "Application_Status")
    private String appStatus;

    //end of columns/variables for applicant table

    //Start of columns/variables for parent table

    @Column(name = "Parent_First_Name", table = "Parent")
    private String parentFName;

    @Column(name = "Parent_Last_Name", table = "Parent")
    private String parentLName;

    @Column(name = "Parent_EMail", table = "Parent")
    private String parentEMail;

    @Column(name = "Parent_Address", table = "Parent")
    private String parentAddress;

    @Column(name = "Parent_City", table = "Parent")
    private String parentCity;

    @Column(name = "Parent_State", table = "Parent")
    private String parentState;

    @Column(name = "Parent_Zip_Code", table = "Parent")
    private String parentZipCode;

    @Column(name = "Parent_Mobile_Phone", table = "Parent")
    private String parentMobilePhone;

    @Column(name = "Parent_Work_Phone", table = "Parent")
    private String parentWorkPhone;

    @Column(name = "Parent_Home_Phone", table = "Parent")
    private String parentHomePhone;

    @Column(name = "Other_Parent_First_Name", table = "Parent")
    private String otherParentFName;

    @Column(name = "Other_Parent_Last_Name", table = "Parent")
    private String otherParentLName;

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

    @Column(name = "Contact_Mobile_Phone", table = "Emergency_Contact")
    private String contactMobilePhone;

    @Column(name = "Contact_Work_Phone", table = "Emergency_Contact")
    private String contactWorkPhone;

    @Column(name = "Contact_Initials", table = "Emergency_Contact")
    private String contactInitials;

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

    public void setAge() {
        this.age = 12;
        //Will have to change this to date of birth calculation
    }

    public String getEthnicity() {
        return ethnicity;
    }

    public void setEthnicity(String ethnicity) {
        this.ethnicity = ethnicity;
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

    public String getShirtSize() {
        return shirtSize;
    }

    public void setShirtSize(String shirtSize) {
        this.shirtSize = shirtSize;
    }

    public String getRecordId() {
        return recordId;
    }

    public void setRecordId() {
        String characters = "01234567890abcdefghijklmnopqrstuvxyz";
        StringBuilder sb = new StringBuilder(8);

        for(int i = 0; i < 8; i++){
            int index = (int)(characters.length() * Math.random());
            sb.append(characters.charAt(index));
        }

        System.out.println(sb.toString());
        this.recordId = sb.toString();
    }

    public String getWaiverStatus() {return waiverStatus;}

    public void setWaiverStatus() {
        this.waiverStatus = "Not Submitted";
    }

    public String getAppStatus() {
        return appStatus;
    }

    public void setAppStatus() {
        this.appStatus = "Pending";
    }

    //end of getters and setters for applicant variables

    //getters and setters for parent variables

    public String getParentFName() {
        return parentFName;
    }

    public void setParentFName(String parentFName) {
        this.parentFName = parentFName;
    }

    public String getParentLName() {
        return parentLName;
    }

    public void setParentLName(String parentLName) {
        this.parentLName = parentLName;
    }

    public String getParentEMail() {
        return parentEMail;
    }

    public void setParentEMail(String parentEMail) {
        this.parentEMail = parentEMail;
    }

    public String getParentAddress() {
        return parentAddress;
    }

    public void setParentAddress(String parentAddress) {
        this.parentAddress = parentAddress;
    }

    public String getParentCity() {
        return parentCity;
    }

    public void setParentCity(String parentCity) {
        this.parentCity = parentCity;
    }

    public String getParentState() {
        return parentState;
    }

    public void setParentState(String parentState) {
        this.parentState = parentState;
    }

    public String getParentZipCode() {
        return parentZipCode;
    }

    public void setParentZipCode(String parentZipCode) {
        this.parentZipCode = parentZipCode;
    }

    public String getParentMobilePhone() {
        return parentMobilePhone;
    }

    public void setParentMobilePhone(String parentMobilePhone) {
        this.parentMobilePhone = parentMobilePhone;
    }

    public String getParentWorkPhone() {
        return parentWorkPhone;
    }

    public void setParentWorkPhone(String parentWorkPhone) {
        this.parentWorkPhone = parentWorkPhone;
    }

    public String getParentHomePhone() {
        return parentHomePhone;
    }

    public void setParentHomePhone(String parentHomePhone) {
        this.parentHomePhone = parentHomePhone;
    }

    public String getOtherParentFName() {
        return otherParentFName;
    }

    public void setOtherParentFName(String otherParentFName) {
        this.otherParentFName = otherParentFName;
    }

    public String getOtherParentLName() {
        return otherParentLName;
    }

    public void setOtherParentLName(String otherParentLName) {
        this.otherParentLName = otherParentLName;
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

    public String getContactMobilePhone() {
        return contactMobilePhone;
    }

    public void setContactMobilePhone(String contactMobilePhone) {
        this.contactMobilePhone = contactMobilePhone;
    }

    public String getContactWorkPhone() {
        return contactWorkPhone;
    }

    public void setContactWorkPhone(String contactWorkPhone) {
        this.contactWorkPhone = contactWorkPhone;
    }

    public String getContactInitials() {
        return contactInitials;
    }

    public void setContactInitials(String contactInitials) {
        this.contactInitials = contactInitials;
    }
}