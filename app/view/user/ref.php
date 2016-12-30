 <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <td>Registration Year</td>
                          <td>Member No.</td>                          
                          <td>Member</td>
                          <td>Seed Acquired</td>
                          <td>Seed Acquired Amount</td>
                          <td>Repayment Type</td>
                          <td>Repayment Amount</td>
                          <td>Status</td>
                          <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                      if ($lstSeedDistribution == 0) {
                      ?>
                        <tr> 
                        <td>Registration Year</td>
                        <td>Member No.</td>                          
                        <td>Member</td>
                        <td>Seed Acquired</td>
                        <td>Seed Acquired Amount</td>
                        <td>Repayment Type</td>
                        <td>Repayment Amount</td>
                        <td>Status</td>
                        <td>Action</td>
                        </tr> 
                        <?php   }
                        else 
                        {
                           foreach($lstSeedDistribution as $value)
                                { 
                                
                                if($value['repaymentMode'] == 'seed'){
                                    $SDID = $value['SDID'];
                                    //get seed amount
                                    $getSeedCropAmount = $seeds->getSeedCropAmount($SDID);
                                    $rapidKgs = $getSeedCropAmount[0][0];
                                }
                                if($value['repaymentMode'] == 'crop'){
                                  $SDID = $value['SDID'];
                                    //get crop amount
                                    $getSeedCropAmount = $seeds->getSeedCropAmount($SDID);
                                    $rapidKgs = $getSeedCropAmount[0][1];
                                }
                                if($value['repaymentMode'] == ''){
                                    $rapidKgs = '';
                                }
                               
                               
                               ?> 
                        <tr> 
                             <td><?php  echo $value['regYear'];?></td>
                             <td><?php  echo $value['memberNumber'] ?></td>
                             <td><?php  echo $value['fname'].' '.$value['lname'] ;?></td>                                                              
                                <td><?php  echo $value['seedname'];?></td>
                                <td><?php  echo $value['acquiredseedkgs'];?></td>
                                <td><?php  echo $value['repaymentMode'];?></td>
                                <td><?php echo $rapidKgs;?></td>
                                <td><?php  echo $value['status'];?></td>
                            <td>
                                <a rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs" 
                                   href="memberprofile.php?Sid=<?php // echo $value['SDID'];?>">
                                    <i class="fa fa-user"></i></a>
                                <a rel="tooltip" title="Add Member To Registration Year" class="btn btn-info btn-simple btn-xs openModalLink" href="/" 
                                   data-id="<?php // echo $value['SDID'] ?>" >
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a rel="tooltip" title="Make payment" class="btn btn-info btn-simple btn-xs openModalLink" href="/" 
                                   data-id="<?php // echo $value['SDID'] ?>" >
                                    <i class="fa fa-money"></i>
                                </a>
<!--                               <a rel="tooltip" title="Edit/Update crop details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php // echo $value['CPID'] ?>" data-viewcode="<?php// echo $value['code'] ?>"
                                  data-viewname="<?php// echo $value['cropname'] ?>" data-viewdesc="<?php// echo $value['cropdescription'] ?>"
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>-->
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>  
                    </tbody>
                  </table>