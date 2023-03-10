<div class="card">
    <div class="card-header pb-0">
      <div class="row">
        <div class="col-lg-6 col-7">
          <h6>Repository</h6>
          <p class="text-sm mb-0">
            <i class="fa fa-check text-info" aria-hidden="true"></i>
            Total <span class="font-weight-bold ms-1">{{ $reposCount }}</span> Repos
          </p>
        </div>
        <div class="col-lg-6 col-5 my-auto text-end">
            {{-- <div class="dropdown float-lg-end pe-4">
                <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-ellipsis-v text-secondary"></i>
                </a>
                <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                </ul>
            </div> --}}
        </div>
      </div>
    </div>
    
    <div class="card-body px-0 pb-2">
      <div class="table-responsive">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Language</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Topic</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Updated</th>
            </tr>
          </thead>
          <tbody>

            @foreach ( $displayRepo as $drepo )
            <tr>
              <td>
                <div class="d-flex px-3 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm text-capitalize">{{ $drepo['name'] }}</h6>
                  </div>
                </div>
              </td>

              <td class="align-middle text-center text-sm">
                <span class="text-xs font-weight-bold">{{ $drepo['language'] }}</span>
              </td>

              <td class="align-middle text-center text-sm">
                <span class="text-xs font-weight-bold">{{ implode(', ', array_slice($drepo['topics'], 0, 3)) }}</span>
              </td>

              <td class="align-middle text-center text-sm">
                <span class="text-xs font-weight-bold">{{ \Carbon\Carbon::parse($drepo['pushed_at'])->diffForHumans() }}</span>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
</div>