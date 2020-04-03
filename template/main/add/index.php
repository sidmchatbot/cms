    <h1 class="add-h1"><?=$key_path?> Course             
    </h1>
    <form action="process.php?type=<?=$key_path == "add" ? "add" : "update";?>" method="POST" data-prevent="false" class="add-edit">
        <div class="controls">
            <input type="submit" name="submit" class="btn"/>
        </div>

        <div class="left">
            <h5>Information</h5>
            <hr>
            <label for="name">
                <p>Name </p>
                <input type="text" name="name" id="name" placeholder="Enter Course Name">
            </label>
            <label for="program">
                <p>Program</p>
                <select name="program" id="program">
                    <option selected disabled>Pick Program</option>
                    <option value="nsa">National Silver Academy</option>
                    <option value="sc">Short Course</option>
                    <option value="sp">Specialist Diploma</option>
                    <option value="wsp">Work-Study Program</option>
                </select>
            </label>
            <label for="description">
                <p>Description </p>
                <textarea rows=10 name="description" id="description" placeholder="Type in the description of the course"></textarea>
            </label>
            <h5>Timing</h5>
            <hr>
            <label for="duration">
                <p>Duration </p>
                <div class="split-content">
                    <input type="number" id="duration" name="duration" min="1" max="10"/>
                    <select id="duration-period" name="duration-period">
                        <option disabled></option>
                        <option value="hour">Hour</option>
                        <option value="day">Day</option>
                        <option value="month">Month</option>
                        <option value="year">Year</option>
                    </select>
                </div>
            </label>
            <div class="split-content">
                <label for="registration">
                    <p>Registration Date </p>
                    <input type="date" name="registration" id="registration"/>
                </label> 
                <label for="start">
                    <p>Commencement Date </p>
                    <input type="date" name="start" id="start"/>
                </label> 
            </div>
        </div>
        <div class="right">
            <h5>Entry Requirement</h5>
            <hr>
            <label for="requirement">
                <p>Requirement</p>
                <textarea name="requirement" id="requirement" rows="10"></textarea>
            </label>
            <label for="fees">
                <p>Fees</p>
                <input type="text" name="fees" id="fees" disabled value="Fee will be added in due time">
            </label>
        </div>
        <input type="hidden" name="redirect" value="<?=str_replace(" ", "+",$prog_path)?>"/>
        <input type="hidden" name="key" value="<?=$key_path == "add" ? "" : $key_path;?>"/>
    </form>
