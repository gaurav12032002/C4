
<div class="container">
  <div class="col-12">
  <h2 class="text-center"><?= esc($title) ?></h2>
    <hr>
      <div class="container mt-5">
        
        <div class="row d-flex justify-content-center">
            
            <div class="col-md-7">
                
                <div class="card p-3 py-4">
                    
                    <div class="text-center">
                 
                    <img src="<?php echo base_url('uploads/'.esc($user['profile_picture'])) ?>"height="200px" width="200px" alt="" class="rounded-circle">
                    </div>
                    
                    <div class="text-center mt-3"> 
                        <h5 class="mt-3 mb-0"><?php echo $user['full_name']; ?></h5>
                       
                        <div class="mt-2 mb-0">
                            <p class="fonts"><?php echo $user['bio']; ?> </p>
                        
                        </div>
                        
                        <div class="buttons">
                            
                            <a href="<?php echo base_url('users/edit'); ?>" class="btn btn-sm btn-primary px-4">Update Profile</a>
                            <a href="<?php echo base_url('users/edit_password'); ?>" class="btn btn-warning btn-primary px-4">Change Password</a>
                        </div>
                        
                        
                    </div>
                    
                  
                    
                    
                </div>
                
            </div>
            
        </div>
        
    </div>
  </div>      
</div>
