<!doctype html>
<html>
    <body>
        <h2>Schedule List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
        <th>No</th>
		<th>username</th>
		<th>day</th>
		<th>Begin_time</th>
		<th>Finish_time</th>
		
            </tr><?php
            foreach ($schedule_data as $schedule)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $schedule->username ?></td>
		      <td><?php echo $schedule->day ?></td>
		      <td><?php echo $schedue->begin_time ?></td>
		      <td><?php echo $schedule->finish_time ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>