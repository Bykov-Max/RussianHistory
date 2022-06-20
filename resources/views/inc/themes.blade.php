<div class="themes">
    @foreach($themes as $theme)
        <div>
            <a href="{{route('show.messages', $theme)}}" class="theme"> {{$theme->name}} </a>
        </div>
    @endforeach
</div>


{{--<script>--}}
{{--    document.querySelectorAll('.btn-basket').forEach(item => {--}}
{{--        item.addEventListener('click', async (e) => {--}}
{{--            e.preventDefault()--}}
{{--           --}}
{{--        })--}}
{{--    })--}}
{{--</script>--}}


{{--<script>--}}
{{--    async function postDataJS(route, theme_id){--}}
{{--        let response = await fetch(route, theme_id)--}}

{{--        return response.json();--}}
{{--    }--}}
{{--</script>--}}

