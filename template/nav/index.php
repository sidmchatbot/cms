<nav>
    <img src="img/sidm-logo.png" alt="logo">
    <ul>
        <li <?= array_search($prog_path, ["home", "index", ""]) > -1 ? "class='active'" : ""; ?>data-name="home"><a href="home">Home</a></li>
        <li <?= $prog_path == "national silver academy" ? "class='active'" : ""; ?>data-name="nsa"><a href="national+silver+academy">National Silver Academy</a></li>
        <li <?= $prog_path == "short course" ? "class='active'" : ""; ?>data-name="sc"><a href="short+course">Short Course</a></li>
        <li <?= $prog_path == "specialist diploma" ? "class='active'" : ""; ?>data-name="sd"><a href="specialist+diploma">Specialist Diploma</a></li>
        <li <?= $prog_path == "work study program" ? "class='active'" : ""; ?>data-name="wsp"><a href="work+study+program">Work-Study Program</a></li>
    </ul>
</nav>