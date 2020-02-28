package com.girlsdayout.applicationform;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

@SpringBootApplication //annotation includes @configuration, @enableautoconfiguration, and @componentscan annotations
public class ApplicationFormApp {

	public static void main(String[] args) {
		SpringApplication.run(ApplicationFormApp.class, args);
	}

}
