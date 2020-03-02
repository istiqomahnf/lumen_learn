<?php
    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class ArticleCollection extends JsonResource 
    {

        public function toJson($request)
        {
            return [
                'article_id'            => $this->article_id,
                'article_title'         => $this->article_title,
                'article_description'   => $this->article_description,
                'article_status'        => $this->article_status,
                'user_id'               => $this->user_id,
                'category_id'           => $this->category_id,
                'created_at'            => $this->created_at,
                'file'                  => $this->file,
            ];
        }
    }
?>