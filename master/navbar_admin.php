 <!-- Side Nav START -->
 <div class="side-nav" style="background-color: offwhite">
     <div class="side-nav-inner">
         <ul class="side-nav-menu scrollable">
             <li class="nav-item dropdown">
                 <a href=<?php echo $Dashboard_link; ?>>
                     <span class="icon-holder">
                         <i class="bi bi-caret-right"></i>
                     </span>
                     <span class="title"><?php echo $Dashboard; ?></span>
                 </a>
             </li>
             <li class="nav-item dropdown">
                 <a href=<?php echo $Department_link; ?>>
                     <span class="icon-holder">
                         <i class="bi bi-caret-right"></i>
                     </span>
                     <span class="title"><?php echo $Department; ?></span>
                 </a>
             </li>
             <!-- evaluation dropdown start -->
             <li class="nav-item dropdown">
                 <a class="dropdown-toggle" href="javascript:void(0);">
                     <span class="icon-holder">
                         <i class="bi bi-caret-right"></i>
                     </span>
                     <span class="title"><?php echo "EVALUATION"; ?></span>
                     <span class="arrow">
                         <i class="arrow-icon"></i>
                     </span>
                 </a>
                 <ul class="dropdown-menu">
                     <li class='nav-item dropdown'>
                         <a href=<?php echo $Evaluation_link; ?>>
                             <span class="icon-holder">
                                 <i class="bi bi-caret-right"></i>
                             </span>
                             <span class="title"><?php echo $Evaluation; ?></span>
                         </a>
                     </li>
                 </ul>
             </li>
             <!-- evaluation dropdown end -->
             <!-- All employee dropdown start -->
             <li class="nav-item dropdown">
                 <a class="dropdown-toggle" href="javascript:void(0);">
                     <span class="icon-holder">
                         <i class="bi bi-caret-right"></i>
                     </span>
                     <span class="title"><?php echo "EMPLOYEE"; ?></span>
                     <span class="arrow">
                         <i class="arrow-icon"></i>
                     </span>
                 </a>
                 <ul class="dropdown-menu">
                     <li class='nav-item dropdown'>
                         <a href=<?php echo $MyTeam_link; ?>>
                             <span class="icon-holder">
                                 <i class="bi bi-caret-right"></i>
                             </span>
                             <span class="title"><?php echo $My_Team; ?></span>
                         </a>
                     </li>

                     <li class='nav-item dropdown'>
                         <a href=<?php echo $AllEmployee_link; ?>>
                             <span class="icon-holder">
                                 <i class="bi bi-caret-right"></i>
                             </span>
                             <span class="title"><?php echo $All_Employee; ?></span>
                         </a>
                     </li>
                 </ul>
             </li>
             <!-- all employee dropdown end -->
             <li class="nav-item dropdown">
                 <a href=<?php echo $Parameter_link; ?>>
                     <span class="icon-holder">
                         <i class="bi bi-caret-right"></i>
                     </span>
                     <span class="title"><?php echo $Parameter; ?></span>
                 </a>
             </li>
             <li class="nav-item dropdown">
                 <a href=<?php echo $Report_link; ?>>
                     <span class="icon-holder">
                         <i class="bi bi-caret-right"></i>
                     </span>
                     <span class="title"><?php echo "REPORTS"; ?></span>
                 </a>
             </li>
         </ul>
     </div>
 </div>
 <!-- Side Nav END -->