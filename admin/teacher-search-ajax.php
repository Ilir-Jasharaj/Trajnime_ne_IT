<?php
// teacher-search-ajax.php

// Check if the searchKey parameter is set
if (isset($_POST['searchKey'])) {
    $searchKey = $_POST['searchKey'];

    // Include the necessary files and database connection
    include "../DB_connection.php";
    include "data/teacher.php";
    include "data/subject.php";

    // Perform the search
    $teachers = searchTeachers($searchKey, $conn);

    if ($teachers != 0) {
        // Generate the search results HTML
        $html = '<table class="table table-bordered mt-3 n-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>';

        $i = 0;
        foreach ($teachers as $teacher) {
            $i++;
            $html .= '<tr>
                        <th scope="row">' . $i . '</th>
                        <td>' . $teacher['teacher_id'] . '</td>
                        <td><a href="teacher-view.php?teacher_id=' . $teacher['teacher_id'] . '">' . (isset($teacher['first_name']) ? $teacher['first_name'] : '') . '</a></td>
                        <td>' . (isset($teacher['last_name']) ? $teacher['last_name'] : '') . '</td>
                        <td>' . $teacher['username'] . '</td>
                        <td>';
        
            $subjects = str_split(trim($teacher['subjects']));
            foreach ($subjects as $subject) {
                $s_temp = getSubjectName($subject, $conn);
                if ($s_temp != 0)
                    $html .= $s_temp . ', ';
            }
        
            $html .= '</td>
                       <td>
                          <a href="teacher-edit.php?teacher_id=' . $teacher['teacher_id'] . '" class="btn btn-warning">Edit</a>
                          <a href="teacher-delete.php?teacher_id=' . $teacher['teacher_id'] . '" class="btn btn-danger">Delete</a>
                       </td>
                     </tr>';
        }
        

        $html .= '</tbody></table>';

        // Return the HTML as the response
        echo $html;
    } else {
        // No results found
        echo '<p>No results found.</p>';
    }
} else {
    // Invalid request
    echo '<p>Invalid request.</p>';
}
?>
