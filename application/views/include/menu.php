<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    
                </a>
            </div>

            <ul class="nav">
                <li class="<?php if ($currentPage == 'dashboard'){echo 'active';}?>">
                    <a href="#">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="<?php if($currentPage =='table'){echo 'active';}?>">
                    <a href="dashboard" >
                        <i class="ti-credit-card"></i>
                        <p>Pay Bills</p>
                    </a>
                </li>
                <li class="<?php if($currentPage =='airtime'){echo 'active';}?>">
                    <a href="#" data-toggle="modal" data-target="#vtu">
                        <i class="ti-mobile"></i>
                        <p>Transfer</p>
                    </a>
                </li>
                <li class="<?php if($currentPage =='user'){echo 'active';}?>">
                    <a href="Home/LogOut">
                        <i class="ti-control-stop"></i>
                        <p>LOG OUT</p>
                    </a>
                </li> 
            </ul>
    	</div>
    </div>
