<?php

namespace ChungNT\LaravelDocs;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\File;
use SEO;

class LaravelDocsController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        SEO::setTitle('Tài liệu Laravel Tiếng Việt');
        try
        {
            $contents = Markdown::convertToHtml(File::get(__DIR__ . '/views/md/readme.md'));
            return view('LRDocs::index', compact('contents'));
        } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
            die("The file doesn't exist");
        }
        return view('LRDocs::readme');
    }

    public function page($page)
    {
        SEO::setTitle(title_case(substr($page, 0, -3)) . ' Tài liệu Laravel Tiếng Việt');
        SEO::setDescription(title_case(substr($page, 0, -3)) . ' Tài liệu Laravel Tiếng Việt');
        SEO::metatags()->addMeta('robots', 'index,follow');
        SEO::metatags()->addKeyword(title_case(substr($page, 0, -3)));
        SEO::metatags()->addMeta('article:published_time', Carbon::now()->toW3CString(), 'property');
        SEO::metatags()->addMeta('article:section', 'Tài liệu', 'property');
        SEO::metatags()->addMeta('article:author', 'https://www.facebook.com/nguyentranchung.b3', 'property');
        SEO::metatags()->addMeta('article:publisher', 'https://www.facebook.com/nguyentranchung.b3', 'property');
        SEO::opengraph()->addProperty('type', 'article');
        SEO::opengraph()->addProperty('locale', 'vi_vn');
        SEO::opengraph()->addProperty('locale:alternate', ['ja_jp', 'en_us']);
        SEO::opengraph()->setUrl(url('laravel/docs/{page}', $page));
        try
        {
            $contents = Markdown::convertToHtml(File::get(__DIR__ . '/views/md/' . $page));
            return view('LRDocs::index', compact('contents'));
        } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
            die("The file doesn't exist");
        } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
            abort(404);
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
