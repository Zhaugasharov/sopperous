<?php  $level = 0;
       $requirement_list = \App\Models\Requirement::where('parent_id',null)->where('is_show',1)->orderBy('sort_num','asc')->get();
?>

@include('cabinet.requirement.requirement-list-loop',
              ['pharmacy_id' => $pharmacy_id,
              'requirement_list' => $requirement_list,
              'level' => $level + 1])


@if(isset($requirement_id))

       <?php $parent_db = \App\Models\Requirement::where('requirement_id',$requirement_id)->where('is_show',1)->first(); ?>

        @if($parent_db != null)

               <?php $parent = $parent_db->parent_id; ?>

               @while($parent != null)
                      <script>
                             $('.parent-{{$parent}}').css('display','block');
                      </script>

                      <?php $parent_db = \App\Models\Requirement::where('requirement_id',$parent)->first(); ?>

                      @if($parent_db != null)
                             <?php $parent = $parent_db->parent_id; ?>
                      @else
                             <?php $parent = null; ?>
                      @endif
                      
               @endwhile

        @endif

@endif

