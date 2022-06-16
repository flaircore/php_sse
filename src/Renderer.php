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


    public function renderMessageList(array $messages, $fromId){
        $messageHtml = "<div class=''>";
        /**
         * @var  $key
         * @var Nick\PhpSse\Entity\Message  $message
         */
        foreach ($messages as $key => $message) {
            $from = $message->getFrom();
            // recipients[] is [] of one item
            // no group chat for now.
            $recipients = $message->getRecipients();
            $msgStr = $message->getMessage();

            $tplBg = $from->getId() == $fromId ? 'bg-primary' : 'bg-light text-dark';

            $messageTpl =
                "
                <div class='d-flex flex-row justify-content-end mb-4 pt-1'>
                    <div>
                        <p class='small p-2 me-3 mb-1 rounded-3 $tplBg'>$msgStr</p>
                        <p class='small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end'>00:06</p>
                    </div>
                    <img src='https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4-bg.webp'
                        alt='avatar user' style='width: 45px; height: 100%;'                   
                    >
                </div>
                ";

            $messageHtml .= $messageTpl;
        }

        $messageHtml .= "</div>";


        return $messageHtml;
    }


}