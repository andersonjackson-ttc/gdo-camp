package com.girlsdayout.applicationform.service;

import org.springframework.stereotype.Service;
import org.springframework.web.multipart.MultipartFile;

import java.io.File;
import java.io.IOException;

@Service
public class WaiverUploadService {

    public void uploadWaiver(MultipartFile file, String path, String recordId, String waiver) throws IOException {
        file.transferTo(new File(path + recordId + waiver));
    }

}
