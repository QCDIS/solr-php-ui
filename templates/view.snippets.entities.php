<?php
$CurrentFacets=array();

foreach ($facets as $field => $facet):
        ?>
        <span class="<?= implode(' ', $facet['class']) ?>" >
        <span class="facet-name"
              title="<?= $facet['title'] ?>"><?= $facet['name'] ?></span>

          <?php


          foreach ($facet['values'] as $value):
            $val=FacetsPreprocessing($value['value'],$facet['name']);

            if($val!="" and !in_array($val,$CurrentFacets))
            {
                array_push($CurrentFacets,$val);
              ?>
                <span class="<?= implode(' ', $value['class']) ?>"><?= $val ?></span>
              <?php
            }

          endforeach; ?>

          <?php if (!empty($facet['more-values'])): ?>
              <?php foreach ($facet['more-values'] as $value):
               $val=FacetsPreprocessing($value['value'],$facet['name']);
            if($val!="" and !in_array($val,$CurrentFacets))
            {
                array_push($CurrentFacets,$val);
              ?>
                <span class="<?= implode(' ', $value['class']) ?>"><?= $val ?></span>
              <?php
            }endforeach; ?>
          <?php endif; // more ?>
        <br />
        <?php
endforeach; // facet
?>



