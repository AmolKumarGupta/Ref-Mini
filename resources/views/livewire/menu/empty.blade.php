<div class="">
    @php
    $msg = "There is no menu item";
    if ($menuSectionId == 0) {
        $msg = "No menu section is selected";
    }
    @endphp
    <style>
        .lh-200px {
            line-height: 200px;
        }
        @media (max-width: 576px) {
            .lh-200px {
                line-height: 1.5;
            }
        }
    </style>
    <h4 class="text-center text-black-50 height-sm-200 lh-200px">{{ $msg }}</h4>
</div>