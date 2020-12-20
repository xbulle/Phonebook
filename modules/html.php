<?php
require_once('querify.php');
class HTML extends Connection {
    use DatasetDetails;
    public function cards () {
        $usersInformation = $this->extract_details('userdetails');
        foreach ($usersInformation as $singleInformation) {
            $dets = $this->extract_details('connectivity', 'user_name', $singleInformation['user_name']);
            foreach ($dets as $single_det) {
                echo '<div class="phonebook-user-card">
                        <div class="phonebook-user-avatar">'.$singleInformation["user_fullname"][0].'</div>
                        <div class="flex-column ov-desc">
                            <span class="phonebook-user-name">'.$singleInformation['user_fullname'].'</span>
                            <span class="phonebook-user-desc">Laravel Backend Developer</span>
                        </div>
                        <div class="flex-column social">
                            <div class="flex">
                                <a href="tel:'.$singleInformation['user_cell'].'"><i class="ti ti-mobile"></i></a>
                                <a href="https://www.facebook.com/'.$single_det['sc_link_fbk'].'" target="_blank"><i class="ti ti-facebook"></i></a>
                                <a href="https://www.instagram.com/'.$single_det['sc_link_ins'].'" target="_blank"><i class="ti ti-instagram"></i></a>
                            </div>
                        </div>
                    </div>';
            }
        }
    }
}