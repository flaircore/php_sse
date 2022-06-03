<?php

namespace Nick\PhpSse;

class Renderer
{

    public function renderList(array $data) {
        /**
         * <ul class="list-group list-group-flush">
        <li class="list-group-item">An item</li>
        <li class="list-group-item">A second item</li>
        <li class="list-group-item">A third item</li>
        </ul>
         */
        $listHtml = "<ul class='list-group list-group-flush'>";
        foreach ($data as $item) {
            $itemId = $item["id"];
            unset($item["id"]);
            $listHtml .= "<li id='$itemId' class='list-group-item'>";
            foreach ($item as $key => $value) {
                if (is_array($value)) {
                    // @todo apply id/key for inner items too.
                    $listHtml .= renderList($value);
                } else {
                    $listHtml .= $value;
                }
              }
            $listHtml .= '</li>';
           }
        $listHtml .= '</ul>';
        return $listHtml;
    }


}