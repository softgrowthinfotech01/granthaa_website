 <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="erp" class="logo">
            <h2 class="text-white"> Admin</h2>
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                <a
                  href="website.php"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
                
                
              </li>
             
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#forms-menu">
                  <i class="fas fa-pen-square"></i>
                  <p>Project Entry</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="forms-menu">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="add_project.php">
                        <span class="sub-item">Add Project</span>
                      </a>
                    </li>
                    <!-- <li>
                      <a href="updateproject.php">
                        <span class="sub-item">Student Registartion</span>
                      </a>
                    </li> -->
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#tablesdata">
                  <i class="fas fa-table"></i>
                  <p>Records</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="tablesdata">
                  <ul class="nav nav-collapse">
                    
                    <li>
                      <a href="project_record.php">
                        <span class="sub-item">Project Record</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#contactdata">
                  <i class="fas fa-comments"></i>
                  <p>Inquiries</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="contactdata">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="contact_record.php">
                        <span class="sub-item">Contact</span>
                      </a>
                    </li>
                    <li>
                      <a href="enquiry_record.php">
                        <span class="sub-item">Enquiry</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              

              <li class="nav-item ">
                <a
                  href="logout.php"
                >
                  <i class="fas fa-sign-out-alt"></i>
                  <p>Logout</p>
                </a>
              </li>

            </ul>
          </div>
        </div>
      </div>