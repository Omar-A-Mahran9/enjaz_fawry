<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Job;
use App\LinkTracker;
use App\Product;
use App\Video;
use App\CommonQuestion;
use App\Branch;
use App\Offer;
use App\CustomField;
use App\CarBrand;




class PublicController extends Controller
{
    public function statusChange($model, $id, $status)
    {
        $models = ['Blog', 'Job', 'LinkTracker', 'Product', 'Video', 'CommonQuestion', 'Branch', 'Offer', 'CustomField'];
        
        if (in_array($model, $models)) {
            switch ($model) {
                case 'Blog':
                    $item = Blog::find($id);
                    $item->status = $status;
                    $item->save();   
                    break;
                case 'Job':
                    $item = Job::find($id);
                    $item->status = $status;
                    $item->save();   
                    break;
                case 'LinkTracker':
                    $item = LinkTracker::find($id);
                    $item->status = $status;
                    $item->save();   
                    break;
                case 'Product':
                    $item = Product::find($id);
                    $item->status = $status;
                    $item->save();   
                    break;            
                case 'Video':
                    $item = Video::find($id);
                    $item->status = $status;
                    $item->save();   
                    break; 
                case 'CommonQuestion':
                    $item = CommonQuestion::find($id);
                    $item->status = $status;
                    $item->save();   
                    break;
                case 'Branch':
                    $item = Branch::find($id);
                    $item->status = $status;
                    $item->save();   
                    break;  
                case 'Offer':
                    $item = Offer::find($id);
                    $item->status = $status;
                    $item->save();   
                    break;  
                case 'CustomField':
                    $item = CustomField::find($id);
                    $item->status = $status;
                    $item->save();   
                    break;                    
                default:
                    
                    break;
                
            }
            return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');    
        }
        return redirect()->back()->with('error', 'لم نجد العنصر المطلوب ');

    }

    public function sortingChange($model, $id, Request $r)
    {
        $models = ['CarBrand', 'CommonQuestion', 'Offer'];

        if (in_array($model, $models)) {
            switch ($model) {
                case 'CommonQuestion':
                    $item = CommonQuestion::find($id);
                    $item->sorting_number = $r->sorting_number;
                    $item->save();   
                    break;
                case 'CarBrand':
                    $item = CarBrand::find($id);
                    $item->sorting_number = $r->sorting_number;
                    $item->save();   
                    break;
                case 'Offer':
                    $item = Offer::find($id);
                    $item->sorting_number = $r->sorting_number;
                    $item->save();   
                    break;    
                default:
                    
                    break;
                
            }
            return redirect()->back()->with('success', 'تم تغير الترتيب بنجاح');    
        }
        return redirect()->back()->with('error', 'لم نجد العنصر المطلوب ');
    }
}
