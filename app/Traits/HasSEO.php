<?php


namespace App\Traits;


use Modules\Core\Models\SEO;

trait HasSEO
{

    public function getSeoMeta($locale = false)
    {
        if(empty($locale)) $locale = request('lang',app()->getLocale());

        if(!$this->seo_type and !$this->type) return;
        $seo_key = $this->seo_type ? $this->seo_type : $this->type;
        if(!empty($locale)) $seo_key = $seo_key."_".$locale;

        $meta = SEO::where('object_id', $this->id )->where('object_model', $seo_key)->first();
        if(!empty($meta)){
            $meta = $meta->toArray();
        }
        $meta['slug'] = $this->slug;
        $meta['full_url'] = url()->current();
        $meta['service_title'] = $this->title ?? $this->name;
        $meta['service_desc'] = $this->short_desc;
        $meta['service_image'] = $this->image_id;
        return $meta;
    }

    public function getSeoMetaWithTranslation($locale = '',$translation = null){
        if(empty($locale)) $locale = app()->getLocale();

        if(is_default_lang($locale)) return $this->getSeoMeta();
        if(!empty($translation->origin_id)){
            $meta = $translation->getSeoMeta( $locale );
            $meta['full_url'] = url()->current();
            $meta['slug'] = $this->slug;
            $meta['service_image'] = $this->image_id;;
            return $meta;
        }
    }

    public function saveSEO(\Illuminate\Http\Request $request  = null, $locale = false)
    {
        if(!$request) $request = request();
        if(empty($locale)){
            $locale = $request->get('lang',app()->getLocale());
        }
        $this->processSaveSEO($request,$locale);
    }

    protected function processSaveSEO(\Illuminate\Http\Request $request , $locale = false){
        if(!$this->seo_type and !$this->type) return;
        $seo_key = $this->seo_type ? $this->seo_type : $this->type;
        if(!empty($locale)) $seo_key = $seo_key."_".$locale;

        $meta = SEO::where('object_id', $this->id)->where('object_model', $seo_key)->first();
        if (!$meta) {
            $meta = new SEO();
            $meta->object_id = $this->id;
            $meta->object_model = $seo_key;
        }
        $meta->fill($request->input());
        return $meta->save();
    }
}
