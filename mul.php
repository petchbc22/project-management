<form method="post" action="fee_allocation.php" class="box validate">
 
                <div class="header">
                    <h2>Student Fees Settings</h2>
                </div>
 
                <div class="content">
 
                <fieldset>
                    <p class="_100 small">
                        <label >Class Name:</label>
 
                        <select   class="search" data-placeholder="Choose a Class" name="class_name">
                        <option value=""></option>
                            <option value="1">Class One</option>
                            <option value="2">Class Two</option>
                            <option value="3">Class Three</option>
                            <option value="4">Class Four</option>
                            <option value="5">Class Five</option>
                            <option value="6">Class Six</option>
                            <option value="7">JHS One</option>
                            <option value="8">JHS Two</option>
                            <option value="9">JHS Three</option>
                        </select>
                    </p>
                    <p class="_75 small">
                        <label>Fee Discription:</label>
                        <select  multiple="multiple" class="search" data-placeholder="Choose a fee" name="fee_description[]">
                        <?php
                        $tempholder = array();
                        $query = mysql_query("SELECT Fee_ID,Fee_Description FROM ViewFees");
                        $nr = mysql_num_rows($query);
                        for($i=0; $i<$nr; $i++) {
                        $row = mysql_fetch_array($query);
                        if(!in_array($row['Fee_Description'],$tempholder)) 
                        {
                        echo"<option></option>";
                        echo'<option value="'.$row['Fee_ID'].'" >'.$row['Fee_Description'].'</option>';
 
                    }
                }
 
                        ?>
 
                    </select>
                    </p>
                    </fieldset>
                    <fieldset>
                    <p  class="_25 small" style="padding-bottom: 10px;">
                    <label >Start Date</label><br>
                    <input type="date"  id="startdate" name="sdate" />
                    </p>
                    <p  class="_25 small" style="padding-bottom: 10px;">
                    <label > End Date</label><br>
                    <input type="date" id="end-date" name="edate" />
                    </p>
                    <p  class="_25 small" style="padding-bottom: 10px;">
                    <label > Due Date</label><br>
                    <input type="date" id="due-date" name="ddate" />
                    </p>
                    </fieldset>
                </div><!-- End of .content -->
 
                <div class="actions">
                    <div class="left">
                        <input type="reset" value="Cancel" />
                    </div>
                    <div class="right">
                        <input type="submit" value="Send"  id="fee-submit" />
                    </div>
                </div><!-- End of .actions -->
            <div id="message"></div>
            </form>