<div class="container-fluid">
	<div class="row p-4">
		<div class="col-8">
			<div class="full-statistics">
				<p>
					<a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Toggle first element</a>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Toggle second element</button>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Toggle both elements</button>
				</p>
				<div class="mt-4">
					<div class="collapse multi-collapse" id="multiCollapseExample1">
						<div class="card card-body">
							Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
						</div>
					</div>
					<div class="collapse multi-collapse" id="multiCollapseExample1">
						<div class="card card-body">
							Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-4 px-5">
			<h4>Краткая статистика:</h4>
			<table class="table table-striped">
				<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Категория</th>
					<th scope="col">|</th>
					<th scope="col">Значение</th>
				</tr>
				</thead>
				<tbody>
					@foreach ($short as $key => $item)
						<tr>
							<td><i>{{ $key+1 }}.</i></td>
							<td>{{ $item['title'] }}</td>
							<td>|</td>
							<th scope="row">{{ $item['count'] }}</th>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<style>

</style>