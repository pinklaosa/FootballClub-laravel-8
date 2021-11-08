<section class="section">
   <h2>นักเตะหลักแนะนำ</h2>
   <h2>ในแผน {{ $plan }}</h2>
   <h1>ตำแหน่ง ประตู</h1>
   @foreach ( $list as $item )
   @if( $item->position == "goalkeeper")
   <p> คือ {{ $item->name }}</p>
   @endif
   @endforeach

   <h1>ตำแหน่ง กองหลัง</h1>
   @foreach ( $list as $item )
   @if( $item->position == "defender")
   <p> คือ {{ $item->name }}</p>
   @endif
   @endforeach

   <h1>ตำแหน่ง กองกลาง</h1>
   @foreach ( $list as $item )
   @if( $item->position == "midfield")
   <p> คือ {{ $item->name }}</p>
   @endif
   @endforeach

   <h1>ตำแหน่ง กองหน้า</h1>
   @foreach ( $list as $item )
   @if( $item->position == "forward")
   <p> คือ {{ $item->name }}</p>
   @endif
   @endforeach
</section>