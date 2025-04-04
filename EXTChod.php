
<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'EXTChod') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAAC Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
       .sidebar {
    width: 17.7%; /* Ensure it matches nav-bar */
    background-color: #2C3E50;
    color: #ffffff;
    padding: 20px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
}

/* Scrollbar styles */
.sidebar::-webkit-scrollbar {
    width: 8px;
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.6);
    border-radius: 6px;
}

#mainContent{
    width:81.5%;
    margin-left: 350px;

}
        
        </style>
</head>
<body>
    <div class="sidebar">
        <h2><i class="fas fa-university"></i> NAAC Criteria</h2>



        <div class="dropdown">
            <button onclick="toggleDropdown('criteria1')"><i class="fas fa-book-open"></i> Criteria 1: Curricular Aspects</button>
            <div id="criteria1" class="dropdown-content">
                
                <a onclick="toggleDropdown('criteria1_1')">1.1 Curricular Planning and Implementation</a>
                <div id="criteria1_1" class="dropdown-content">
                    <a onclick="loadContent('University Academic Calendar')">- University Academic Calendar</a>
                    <a onclick="loadContent('Institute Academic Calendar')">- Institute Academic Calendar</a>
                    <a onclick="loadContent('Course Curriculum')">- Course Curriculum</a>
                    <a onclick="loadContent('Time Table')">- Time Table</a>
                    <a onclick="loadContent('Teaching Load Distribution')">- Teaching Load Distribution</a>
                    <a onclick="loadContent('Lab Assessment Reports')">- Lab Assessment Reports</a>
                    <a onclick="loadContent('Session Plans')">- Session Plans</a>
                    <a onclick="loadContent('ST and PUT Exam Dates')">- ST and PUT Exam Dates</a>
                    <a onclick="loadContent('ST and PUT Marks')">- ST and PUT Marks</a>
                    <a onclick="loadContent('Sample Course Files')">- Sample Course Files</a>
                </div>
        
                <a onclick="toggleDropdown('criteria1_2')">1.2 Academic Flexibility</a>
                <div id="criteria1_2" class="dropdown-content">
                    <a onclick="loadContent('Elective Courses Offered')">- Elective Courses Offered</a>
                    <a onclick="loadContent('Value-Added Courses')">- Value-Added Courses</a>
                    <a onclick="loadContent('Interdisciplinary Courses')">- Interdisciplinary Courses</a>
                    <a onclick="loadContent('Choice Based Credit System (CBCS)')">- Choice Based Credit System (CBCS)</a>
                </div>
        
                <a onclick="toggleDropdown('criteria1_3')">1.3 Curriculum Enrichment</a>
                <div id="criteria1_3" class="dropdown-content">
                    <a onclick="loadContent('Integration of Cross-cutting Issues')">- Integration of Cross-cutting Issues</a>
                    <a onclick="loadContent('Professional Ethics and Environmental Studies')">- Professional Ethics and Environmental Studies</a>
                    <a onclick="loadContent('Soft Skill Development Programs')">- Soft Skill Development Programs</a>
                    <a onclick="loadContent('Gender Sensitization Initiatives')">- Gender Sensitization Initiatives</a>
                </div>
        
                <a onclick="toggleDropdown('criteria1_4')">1.4 Feedback System</a>
                <div id="criteria1_4" class="dropdown-content">
                    <a onclick="loadContent('Feedback from Students')">- Feedback from Students</a>
                    <a onclick="loadContent('Feedback from Faculty')">- Feedback from Faculty</a>
                    <a onclick="loadContent('Feedback from Employers')">- Feedback from Employers</a>
                    <a onclick="loadContent('Action Taken Reports')">- Action Taken Reports</a>
                </div>
        
            </div>
        </div>
        



        <div class="dropdown">
            <button onclick="toggleDropdown('criteria2')"><i class="fas fa-chalkboard-teacher"></i> Criteria 2: Teaching-Learning and Evaluation</button>
            <div id="criteria2" class="dropdown-content">
                
                <a onclick="toggleDropdown('criteria2_1')">2.1 Student Enrollment and Profile</a>
                <div id="criteria2_1" class="dropdown-content">
                    <a onclick="loadContent('Student Enrollment Details')">- Student Enrollment Details</a>
                    <a onclick="loadContent('Diversity of Students')">- Diversity of Students</a>
                    <a onclick="loadContent('Demand Ratio')">- Demand Ratio</a>
                </div>
        
                <a onclick="toggleDropdown('criteria2_2')">2.2 Catering to Student Diversity</a>
                <div id="criteria2_2" class="dropdown-content">
                    <a onclick="loadContent('Bridge Courses')">- Bridge Courses</a>
                    <a onclick="loadContent('Remedial Classes')">- Remedial Classes</a>
                    <a onclick="loadContent('Advanced Learner Programs')">- Advanced Learner Programs</a>
                </div>
        
                <a onclick="toggleDropdown('criteria2_3')">2.3 Teaching-Learning Process</a>
                <div id="criteria2_3" class="dropdown-content">
                    <a onclick="loadContent('Experiential Learning')">- Experiential Learning</a>
                    <a onclick="loadContent('Participative Learning')">- Participative Learning</a>
                    <a onclick="loadContent('Innovative Teaching Methods')">- Innovative Teaching Methods</a>
                    <a onclick="loadContent('ICT Integration in Teaching')">- ICT Integration in Teaching</a>
                </div>
        
                <a onclick="toggleDropdown('criteria2_4')">2.4 Teacher Profile and Quality</a>
                <div id="criteria2_4" class="dropdown-content">
                    <a onclick="loadContent('Faculty Qualifications')">- Faculty Qualifications</a>
                    <a onclick="loadContent('Faculty Development Programs')">- Faculty Development Programs</a>
                    <a onclick="loadContent('Faculty Retention')">- Faculty Retention</a>
                </div>
        
                <a onclick="toggleDropdown('criteria2_5')">2.5 Evaluation Process and Reforms</a>
                <div id="criteria2_5" class="dropdown-content">
                    <a onclick="loadContent('Continuous Internal Evaluation')">- Continuous Internal Evaluation</a>
                    <a onclick="loadContent('Transparency in Evaluation')">- Transparency in Evaluation</a>
                    <a onclick="loadContent('Grievance Redressal in Examinations')">- Grievance Redressal in Examinations</a>
                </div>
        
                <a onclick="toggleDropdown('criteria2_6')">2.6 Student Performance and Learning Outcomes</a>
                <div id="criteria2_6" class="dropdown-content">
                    <a onclick="loadContent('Program Outcomes (POs)')">- Program Outcomes (POs)</a>
                    <a onclick="loadContent('Course Outcomes (COs)')">- Course Outcomes (COs)</a>
                    <a onclick="loadContent('Student Academic Performance')">- Student Academic Performance</a>
                </div>
        
                <a onclick="toggleDropdown('criteria2_7')">2.7 Student Satisfaction Survey (SSS)</a>
                <div id="criteria2_7" class="dropdown-content">
                    <a onclick="loadContent('SSS Reports')">- SSS Reports</a>
                    <a onclick="loadContent('Feedback Analysis')">- Feedback Analysis</a>
                    <a onclick="loadContent('Action Taken Reports')">- Action Taken Reports</a>
                </div>
        
            </div>
        </div>
        


       
        <div class="dropdown">
            <button onclick="toggleDropdown('criteria3')"><i class="fas fa-lightbulb"></i> Criteria 3: Research, Innovations, and Extension</button>
            <div id="criteria3" class="dropdown-content">
                
                <a onclick="toggleDropdown('criteria3_1')">3.1 Resource Mobilization for Research</a>
                <div id="criteria3_1" class="dropdown-content">
                    <a onclick="loadContent('Research Funding and Grants')">- Research Funding and Grants</a>
                    <a onclick="loadContent('Faculty Research Projects')">- Faculty Research Projects</a>
                    <a onclick="loadContent('Industry-Sponsored Projects')">- Industry-Sponsored Projects</a>
                </div>
        
                <a onclick="toggleDropdown('criteria3_2')">3.2 Innovation Ecosystem</a>
                <div id="criteria3_2" class="dropdown-content">
                    <a onclick="loadContent('Incubation Centers')">- Incubation Centers</a>
                    <a onclick="loadContent('Innovation and Start-ups')">- Innovation and Start-ups</a>
                    <a onclick="loadContent('Entrepreneurship Development Programs')">- Entrepreneurship Development Programs</a>
                </div>
        
                <a onclick="toggleDropdown('criteria3_3')">3.3 Research Publications and Awards</a>
                <div id="criteria3_3" class="dropdown-content">
                    <a onclick="loadresearch_papers()">- Research Papers Published</a>
                    <a onclick="loadChaptersPublished()">- Books and Chapters Published</a>
                    <a onclick="loadResearchAwards()">- Awards for Research</a>
                </div>
        
                <a onclick="toggleDropdown('criteria3_4')">3.4 Extension Activities</a>
                <div id="criteria3_4" class="dropdown-content">
                    <a onclick="loadContent('Extension and Outreach Program')">- No of extension & Outreach Program</a>
                    <a onclick="loadContent('Awards & Recognition Received')">- Awards & Recognition Received</a>
                    <a onclick="loadContent('Collaborations with NGOs')">- Collaborations with NGOs</a>
                </div>
        
                <a onclick="toggleDropdown('criteria3_5')">3.5 Collaboration</a>
                <div id="criteria3_5" class="dropdown-content">
                    <a onclick="loadMoUsWithInstitutions()" >- MoUs with Institutions</a>
                    <a onclick="loadIndustryAcdemiaLinkages()" >- Industry-Academia Linkages</a>
                    <a onclick="loadMoUsSignedDuringTheYear()">- MoU's Signed During the Year</a>
                </div>
        
            </div>
        </div>

        



        
            
            <div class="dropdown">
                <button onclick="toggleDropdown('criteria4')"><i class="fas fa-building"></i> Criteria 4: Infrastructure and Learning Resources</button>
                <div id="criteria4" class="dropdown-content">
                    
                    <a onclick="toggleDropdown('criteria4_1')">4.1 Physical Facilities</a>
                    <div id="criteria4_1" class="dropdown-content">
                        
                        <a onclick="toggleDropdown('criteria4_1_1')">4.1.1 Infrastructure Details</a>
                        <div id="criteria4_1_1" class="dropdown-content">
                            <a onclick="loadCampusArea()">- Campus Area</a>
                            <a onclick="loadClassroomFacility()">- Classroom Facilities</a>
                            <a onclick="loadLaboratoryFacility()">- Laboratory Facilities</a>
                            <a onclick="loadLibraryResources()">- Library Resources</a>
                            <a onclick="loadICTFacilities()">- ICT Facilities</a>
                        </div>
                        
                        <a onclick="toggleDropdown('criteria4_1_2')">4.1.2 Maintenance of Campus Infrastructure</a>
                        <div id="criteria4_1_2" class="dropdown-content">
                            <a onclick="loadContent('Maintenance Policies')">- Maintenance Policies</a>
                            <a onclick="loadContent('Annual Budget')">- Annual Budget</a>
                            <a onclick="loadContent('Repair Records')">- Repair Records</a>
                        </div>
                        
                    </div>
        
                    <a onclick="toggleDropdown('criteria4_2')">4.2 Library as a Learning Resource</a>
                    <div id="criteria4_2" class="dropdown-content">
                        <a onclick="loadContent('Library Automation')">- Library Automation</a>
                        <a onclick="loadContent('E-Resources')">- E-Resources</a>
                        <a onclick="loadContent('Library Budget')">- Library Budget</a>
                    </div>
        
                    <a onclick="toggleDropdown('criteria4_3')">4.3 IT Infrastructure</a>
                    <div id="criteria4_3" class="dropdown-content">
                        <a onclick="loadContent('IT Facilities')">- IT Facilities</a>
                        <a onclick="loadContent('Wi-Fi Access')">- Wi-Fi Access</a>
                        <a onclick="loadContent('Software Licenses')">- Software Licenses</a>
                    </div>
        
                    <a onclick="toggleDropdown('criteria4_4')">4.4 Maintenance of Campus Infrastructure</a>
                    <div id="criteria4_4" class="dropdown-content">
                        <a onclick="loadContent('Infrastructure Maintenance')">- Infrastructure Maintenance</a>
                        <a onclick="loadContent('Annual Maintenance Budget')">- Annual Maintenance Budget</a>
                        <a onclick="loadContent('Equipment Maintenance')">- Equipment Maintenance</a>
                    </div>
        
                </div>
            </div>
        

        


        <div class="dropdown">
            <button onclick="toggleDropdown('criteria5')"><i class="fas fa-user-graduate"></i> Criteria 5: Student Support and Progression</button>
            <div id="criteria5" class="dropdown-content">
                
                <a onclick="toggleDropdown('criteria5_1')">5.1 Student Support</a>
                <div id="criteria5_1" class="dropdown-content">
                    
                    <a onclick="toggleDropdown('criteria5_1_1')">5.1.1 Scholarships and Financial Support</a>
                    <div id="criteria5_1_1" class="dropdown-content">
                        <a onclick="loadContent('Scholarship Details')">- Scholarship Details</a>
                        <a onclick="loadContent('Government Schemes')">- Government Schemes</a>
                        <a onclick="loadContent('Institutional Support')">- Institutional Support</a>
                    </div>
                    
                    <a onclick="toggleDropdown('criteria5_1_2')">5.1.2 Capacity Building and Skill Development</a>
                    <div id="criteria5_1_2" class="dropdown-content">
                        <a onclick="loadContent('Soft Skills Training')">- Soft Skills Training</a>
                        <a onclick="loadContent('Language Skills Development')">- Language Skills Development</a>
                        <a onclick="loadContent('ICT Skills Enhancement')">- ICT Skills Enhancement</a>
                    </div>
                    
                    <a onclick="toggleDropdown('criteria5_1_3')">5.1.3 Guidance for Competitive Exams and Career Counseling</a>
                    <div id="criteria5_1_3" class="dropdown-content">
                        <a onclick="loadContent('Career Counseling Sessions')">- Career Counseling Sessions</a>
                        <a onclick="loadContent('Coaching for Competitive Exams')">- Coaching for Competitive Exams</a>
                    </div>
        
                </div>
        
                <a onclick="toggleDropdown('criteria5_2')">5.2 Student Progression</a>
                <div id="criteria5_2" class="dropdown-content">
                    <a onclick="loadContent('Student Progression to Higher Education')">- Student Progression to Higher Education</a>
                    <a onclick="loadContent('Placement Records')">- Placement Records</a>
                    <a onclick="loadContent('Entrepreneurship Initiatives')">- Entrepreneurship Initiatives</a>
                </div>
        
                <a onclick="toggleDropdown('criteria5_3')">5.3 Student Participation and Activities</a>
                <div id="criteria5_3" class="dropdown-content">
                    <a onclick="loadContent('Cultural Events')">- Cultural Events</a>
                    <a onclick="loadContent('Sports Participation')">- Sports Participation</a>
                    <a onclick="loadContent('Community Engagement')">- Community Engagement</a>
                </div>
        
                <a onclick="toggleDropdown('criteria5_4')">5.4 Alumni Engagement</a>
                <div id="criteria5_4" class="dropdown-content">
                    <a onclick="loadContent('Alumni Association Activities')">- Alumni Association Activities</a>
                    <a onclick="loadContent('Alumni Contributions')">- Alumni Contributions</a>
                    <a onclick="loadContent('Alumni Networking Events')">- Alumni Networking Events</a>
                </div>
        
            </div>
        </div>

        




        <div class="dropdown">
            <button onclick="toggleDropdown('criteria6')"><i class="fas fa-cogs"></i> Criteria 6: Governance, Leadership, and Management</button>
            <div id="criteria6" class="dropdown-content">
                
                <a onclick="toggleDropdown('criteria6_1')">6.1 Institutional Vision and Leadership</a>
                <div id="criteria6_1" class="dropdown-content">
                    <a onclick="loadContent('Vision and Mission')">- Vision and Mission</a>
                    <a onclick="loadContent('Leadership Structure')">- Leadership Structure</a>
                    <a onclick="loadContent('Strategic Plan')">- Strategic Plan</a>
                </div>
        
                <a onclick="toggleDropdown('criteria6_2')">6.2 Strategy Development and Deployment</a>
                <div id="criteria6_2" class="dropdown-content">
                    <a onclick="loadContent('Institutional Policies')">- Institutional Policies</a>
                    <a onclick="loadContent('Strategic Implementation')">- Strategic Implementation</a>
                    <a onclick="loadContent('Academic and Administrative Planning')">- Academic and Administrative Planning</a>
                </div>
        
                <a onclick="toggleDropdown('criteria6_3')">6.3 Faculty Empowerment Strategies</a>
                <div id="criteria6_3" class="dropdown-content">
                    <a onclick="loadContent('Faculty Development Programs')">- Faculty Development Programs</a>
                    <a onclick="loadContent('Performance Appraisal')">- Performance Appraisal</a>
                    <a onclick="loadContent('Financial Support for Faculty')">- Financial Support for Faculty</a>
                </div>
        
                <a onclick="toggleDropdown('criteria6_4')">6.4 Financial Management and Resource Mobilization</a>
                <div id="criteria6_4" class="dropdown-content">
                    <a onclick="loadContent('Budget Planning and Allocation')">- Budget Planning and Allocation</a>
                    <a onclick="loadContent('Resource Mobilization')">- Resource Mobilization</a>
                    <a onclick="loadContent('Financial Audit Reports')">- Financial Audit Reports</a>
                </div>
        
                <a onclick="toggleDropdown('criteria6_5')">6.5 Internal Quality Assurance System (IQAS)</a>
                <div id="criteria6_5" class="dropdown-content">
                    <a onclick="loadContent('IQAC Initiatives')">- IQAC Initiatives</a>
                    <a onclick="loadContent('Quality Audits')">- Quality Audits</a>
                    <a onclick="loadContent('Continuous Improvement Mechanisms')">- Continuous Improvement Mechanisms</a>
                </div>
        
            </div>
        </div>

        


        <div class="dropdown">
            <button onclick="toggleDropdown('criteria7')"><i class="fas fa-balance-scale"></i> Criteria 7: Institutional Values and Best Practices</button>
            <div id="criteria7" class="dropdown-content">
                
                <a onclick="toggleDropdown('criteria7_1')">7.1 Institutional Values and Social Responsibilities</a>
                <div id="criteria7_1" class="dropdown-content">
                    <a onclick="loadContent('Gender Equity Initiatives')">- Gender Equity Initiatives</a>
                    <a onclick="loadContent('Environmental Consciousness and Sustainability')">- Environmental Consciousness and Sustainability</a>
                    <a onclick="loadContent('Inclusive Campus Initiatives')">- Inclusive Campus Initiatives</a>
                    <a onclick="loadContent('Energy Conservation Measures')">- Energy Conservation Measures</a>
                    <a onclick="loadContent('Waste Management Practices')">- Waste Management Practices</a>
                    <a onclick="loadContent('Green Campus Initiatives')">- Green Campus Initiatives</a>
                </div>
        
                <a onclick="toggleDropdown('criteria7_2')">7.2 Best Practices</a>
                <div id="criteria7_2" class="dropdown-content">
                    <a onclick="loadContent('Best Practice 1')">- Best Practice 1</a>
                    <a onclick="loadContent('Best Practice 2')">- Best Practice 2</a>
                    <a onclick="loadContent('Community Engagement Programs')">- Community Engagement Programs</a>
                    <a onclick="loadContent('Innovative Teaching Practices')">- Innovative Teaching Practices</a>
                </div>
        
                <a onclick="toggleDropdown('criteria7_3')">7.3 Institutional Distinctiveness</a>
                <div id="criteria7_3" class="dropdown-content">
                    <a onclick="loadContent('Unique Institutional Features')">- Unique Institutional Features</a>
                    <a onclick="loadContent('Community and Social Impact')">- Community and Social Impact</a>
                    <a onclick="loadContent('Achievements and Recognitions')">- Achievements and Recognitions</a>
                </div>
            </div>
        </div>
        <div class="dropdown">
    <button onclick="toggleDropdown('User')">
        <i class="fas fa-user-graduate"></i> User
    </button>
    <div id="User" class="dropdown-content">
        <a onclick="loadUser()">- User Deatails</a>
    </div>
</div>
        
        </div>
    </div>

    <nav class="navbar ">
    <h4 class="mb-0">&nbsp;&nbsp;<i class="fas fa-university"></i> <span class="ml-2">&nbsp;&nbsp;SIPNA COLLEGE OF ENGINEERING & TECHNOLOGY, AMRAVATI</span></h4>
   
        <a href="#" class="navbar-brand"></a>
        <div class="user-dropdown">
            <button id="userDropdownButton">

                <i class="fas fa-user-circle account-icon"></i>
                
        <span class="user-name">EXTC(Head Of Department)</span>
    
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="user-dropdown-menu">
                <a href="#" id="profile"><i class="fas fa-user"></i>&nbsp&nbsp;Profile</a>
                <a href="change_password_form.php" id="changePassword"><i class="fas fa-lock"></i>&nbsp&nbsp;Change Password</a>
                <div class="dropdown-divider"></div>
                <a href="logout.php" id="logout"><i class="fas fa-sign-out-alt"></i>&nbsp&nbsp;Logout</a>
            </div>
        </div>
    </nav>
</div>


    
    <div class="content" id="mainContent">
        <h2>Welcome to NAAC Document Hub</h2>
        <p>Select a criterion from the left menu to view details.</p>
    </div>

    <script>
        function loadUser() {
        fetch('UserEXTC.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('mainContent').innerHTML = data;
            })
            .catch(error => {
                console.error('Error loading Campus Area form:', error);
                document.getElementById('mainContent').innerHTML = '<p>Unable to load the Campus Area form. Please try again later.</p>';
            });
}

            function loadCampusArea() {
        fetch('hcampus.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('mainContent').innerHTML = data;
            })
            .catch(error => {
                console.error('Error loading Campus Area form:', error);
                document.getElementById('mainContent').innerHTML = '<p>Unable to load the Campus Area form. Please try again later.</p>';
            });
    }


         function loadClassroomFacility() {
        fetch('hclassroom_facilities.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('mainContent').innerHTML = data;
            })
            .catch(error => {
                console.error('Error loading Campus Area form:', error);
                document.getElementById('mainContent').innerHTML = '<p>Unable to load the Campus Area form. Please try again later.</p>';
            });
    }


      function loadLaboratoryFacility() {
        fetch('hlaboratory_facilities.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('mainContent').innerHTML = data;
            })
            .catch(error => {
                console.error('Error loading Campus Area form:', error);
                document.getElementById('mainContent').innerHTML = '<p>Unable to load the Campus Area form. Please try again later.</p>';
            });
    }

     function loadMoUsSignedDuringTheYear() {
        fetch('EXTCMoUs_data.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('mainContent').innerHTML = data;
            })
            .catch(error => {
                console.error('Error loading Campus Area form:', error);
                document.getElementById('mainContent').innerHTML = '<p>Unable to load the Campus Area form. Please try again later.</p>';
            });
    }

    function loadresearch_papers() {
        fetch('EXTCresearch_papers.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('mainContent').innerHTML = data;
            })
            .catch(error => {
                console.error('Error loading Campus Area form:', error);
                document.getElementById('mainContent').innerHTML = '<p>Unable to load the Campus Area form. Please try again later.</p>';
            });
    }
    
 
    function loadChaptersPublished() {
        fetch('EXTCbook_chapter_publications.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('mainContent').innerHTML = data;
            })
            .catch(error => {
                console.error('Error loading Campus Area form:', error);
                document.getElementById('mainContent').innerHTML = '<p>Unable to load the Campus Area form. Please try again later.</p>';
            });
    }

    
    function loadResearchAwards() {
        fetch('EXTCresearch_awards.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('mainContent').innerHTML = data;
            })
            .catch(error => {
                console.error('Error loading Campus Area form:', error);
                document.getElementById('mainContent').innerHTML = '<p>Unable to load the Campus Area form. Please try again later.</p>';
            });
    }


 

    
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('show');
            dropdown.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function loadContent(section) {
            document.getElementById('mainContent').innerHTML = `
                <h2>${section}</h2>
                <p>Content for ${section} will be displayed here.</p>
            `;
        }

         document.getElementById('userDropdownButton').addEventListener('click', function () {
            const dropdownMenu = document.querySelector('.user-dropdown-menu');
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        
        
        document.addEventListener('click', function (e) {
            const dropdown = document.querySelector('.user-dropdown');
            const dropdownMenu = document.querySelector('.user-dropdown-menu');
            if (!dropdown.contains(e.target)) {
                dropdownMenu.style.display = 'none';
            }
        });



    </script>
</body>
</html>
