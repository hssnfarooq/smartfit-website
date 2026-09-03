<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\NestedModuleController as BaseModuleController;
use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Fields\Checkbox;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Fieldset;
use A17\Twill\Services\Forms\Option;
use A17\Twill\Services\Forms\Options;
use Lunar\Models\Product;

class PageController extends BaseModuleController
{
    protected $moduleName = 'pages';
    protected $showOnlyParentItemsInBrowsers = true;
    protected $nestedItemsDepth = 1;
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->enableReorder();
        $this->setPermalinkBase('');
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            Input::make()->name('title')->label('Title')
        );
        /* description ću koristiti ko polje za id proizvoda da mogu polinkati proizvode/servise s pageom
        $form->add(
            Input::make()
                ->name('description')
                ->label('Short text')
                ->maxLength(1000)
                ->type('textarea')
        );
*/

        ///////////////////////////////////////
        // blok editor ///////////////////////
        if($model->id === 1)   
            ///home page
            $form->addFieldset(    
                Fieldset::make()->title('Home Page elements')->id('page_blok')
                    ->fields([BlockEditor::make()->label('Add Item')->blocks(['home-registacija-search-video', 'testimonials', 'logotipovi1', 'home-gume', 'tabovi1', 'nabrajanje', 'nabrajanje2', 'counter1', 'ispis_s_ikonama', 'video1', 'banner1', 'banner2', 'banner3', 'banner-2-boxa', 'paketi_ispis', 'paketi_ispis2', 'kontakti1', 'testimonials', 'logotipovi1', 'logotipovi2', 'home-slika-tekst'])])//'home_tekst_slika_crno'
            );
        else{
            /*
            $form->add(
                Input::make()
                    ->name('description')
                    ->label('Sevice/Product ID from SHOP HUB')
                    ->note('If you want to connect this text with product')
                    ->maxLength(5)
            );*/
            
            /*$dd_proizvodi = Product::where('product_type_id', '<>', 1)->where('status', 'published')->get();
            foreach($dd_proizvodi as $proizvod)
                $tmp[] = Option::make($proizvod->id, $proizvod->translateAttribute('name'));*/

            ///ostalo
            $form->addFieldset(    
                Fieldset::make()->title('Whole width page elements')
                    ->fields([BlockEditor::make()->label('Add Item')->blocks(['page_head1', 'html_tekst', 'html_tekst_servisi', 'logotipovi1', 'gume-katalog', 'mots', 'ispis_s_ikonama', 'video1', 'banner1', 'banner2', 'paketi_ispis', 'paketi_ispis2', 'logotipovi1', 'logotipovi2', 'kontakti1', 'kontakt_forma1', 'vezani_services'])])//->blocks(['dinamo'])
            );
/*
            $form->addFieldset(    
                Fieldset::make()->title('Left column elements (*optional for 2 column page)')
                    ->fields([BlockEditor::make()->label('Add Item')->name('lijeva_kolona')->blocks(['page_head1', 'html_tekst', 'citat', 'ispis_s_ikonama', 'video1', 'banner1', 'banner2', 'paketi_ispis', 'paketi_ispis2', 'logotipovi1', 'logotipovi2'])])//->blocks(['dinamo'])
            );

            $form->addFieldset(    
                Fieldset::make()->title('Right column elements (*optional for 2 column page)')
                    ->fields([BlockEditor::make()->name('desna_kolona')->label('Add Item')->blocks(['video1'])])//->blocks(['dinamo'])
            );
            $form->add(
                Checkbox::make()->name('dve_kolone')->label('2 column page')
            );*/
            $form->add(
                Medias::make()
                    ->name('slika_head')
                    ->label('Header Picture')
                    ->max(1)
            );

            
        }
        //////////////////////////////////
        /////////////////////////////////


        $form->addFieldset(
            Fieldset::make()
            ->title(trans('twill-metadata::form.titles.fieldset'))
            ->id('metadata')
            ->fields([
                \A17\Twill\Services\Forms\BladePartial::make()->view('twill-metadata::includes.metadata-fields')
                ->withAdditionalParams([
                    'metadata_card_type_options' => config('metadata.card_type_options'),
                    'metadata_og_type_options' => config('metadata.opengraph_type_options'),
                ]),
            ])
        );

        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = parent::additionalIndexTableColumns();

        $table->add(
            Text::make()->field('description')->title('Description')
        );

        return $table;
    }
}
