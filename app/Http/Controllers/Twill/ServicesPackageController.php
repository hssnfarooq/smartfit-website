<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use A17\Twill\Services\Forms\Fields\Checkbox;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Option;
use A17\Twill\Services\Forms\Options;
use Illuminate\Support\Facades\DB;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;

class ServicesPackageController extends BaseModuleController
{
    protected $moduleName = 'servicesPackages';
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->disablePermalink();
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {

        $dd_proizvodi = Product::where('product_type_id', '<>', 1)->where('status', 'published')->get();
        foreach($dd_proizvodi as $proizvod)
            $tmp[] = Option::make($proizvod->id, $proizvod->translateAttribute('name'));

        $form = parent::getForm($model);

        $form->add(
            Input::make()->name('title')->label('Title')
        );

        $form->add(
            Input::make()
                ->name('description')
                ->label('Short text')
                ->maxLength(500)
                ->type('textarea')
        );

        $form->add(
            Wysiwyg::make()
                ->name('long_text')
                ->label('Long text')
                ->allowSource(true)
        );

        $form->add(
            Select::make()
                ->name('prod_id')
                ->label('Select Service')
                ->options(
                    Options::make($tmp/*[
                        Option::make('value', 'label'),
                        Option::make('value', 'label', selectable: false),
                    ]*/)
            )
        );

        $form->add(
            Input::make()->name('price')->label('Price')
        );

        $form->add(
            Input::make()->name('action_price')->label('Action Price')
        );

        $form->add(
            Input::make()->name('lbl')->label('Price Label')
        );



        $form->add(
            Checkbox::make()->name('izdvojeno')->label('Recommended')
        );
        
        $form->add(
            Medias::make()
                ->name('slika')
                ->label('Picture')
                ->max(1)
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
