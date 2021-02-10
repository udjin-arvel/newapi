<?php
    
    namespace App\Providers;

    use App\Models\Fragment;
    use Illuminate\Support\ServiceProvider;
    
    class BookHelperServiceProvider extends ServiceProvider
    {
        /**
         * Получить ids из массива фрагментов
         *
         * @param $fragments
         * @param bool $withFakes
         * @return array
         */
        public static function getIdsFromFragments($fragments, $withFakes = false) {
            $ids = [];
            
            foreach ($fragments as $fragment) {
                if ($withFakes) {
                    $isFakeId = Fragment::isFakeFragment($fragment);
                    
                    if (!$isFakeId) {
                        $ids[] = $fragment['id'];
                    }
                } else {
                    $ids[] = $fragment['id'];
                }
            }
            
            return $ids;
        }
    }
