danh sach san pham
<?php 

echo "
<table style='border: 2px solid black;'>
<thead>
<tr>
<th>id</th>
<th>name</th>
<th>slug</th>
<th>description</th>
<th>created_at</th>
<th>updated_at</th>
</tr>
</thead>
<tbody>";
foreach ($product_list as $value) {
	echo "<tr>
			<td>$value[id]</td>
			<td>$value[name]</td>
			<td>$value[slug]</td>
			<td>$value[description]</td>
			<td>$value[created_at]</td>
			<td>$value[update_at]</td>
		</tr>";
}
echo "</tbody>
</table>";
