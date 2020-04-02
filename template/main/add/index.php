    <h1><?=$key_path?> Course</h1>
    <form action="process.php" class="add-edit">
        <div class="left">
            <h5>Information</h5>
            <hr>
            <label for="name">
                <p>Name </p>
                <input type="text" name="name" id="name" placeholder="Enter Course Name">
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
            <label for="fees">
                
            </label>
        </div>
        <input type="hidden" name="key" value="<?=$key_path == "add" ? "" : $key_path;?>"/>
    </form>
