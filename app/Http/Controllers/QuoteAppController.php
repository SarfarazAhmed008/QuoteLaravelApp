<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;

use App\Author;
use App\Quote;

use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;

use App\AuthorLog;


class QuoteAppController extends Controller
{
	public function getHome($author = null)
	{
		if(!is_null($author)){
			$quote_author = Author::where('name', $author)->first();
			if ($quote_author){
				$quotes = $quote_author->quotes()->orderBy('created_at', 'desc')->paginate(4);
			}
		}
		else{
			$quotes = Quote::orderBy('created_at', 'desc')->paginate(4);
		}

		return view('home', ['quotes' => $quotes] );
	}

	public function postQuote(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|alpha|max:60',
			'quote' => 'required|max:500',
			'email' => 'required|email'
		]);

		$authorText = ucfirst($request['name']);
		$quoteText = $request['quote'];

		$author = Author:: where('name', $authorText)->first();

		if (!$author)
		{
			$author = new Author();
			$author->name = $authorText;
			$author->email = $request['email'];
			$author->save();
		} 
		$quote = new Quote();
		$quote->quote = $quoteText;
		$author->quotes()->save($quote);


		Event::fire(new QuoteCreated($author));


		return redirect()->route('home')->with([
			'success' => 'Quote Posted Successfully !'
		]);
	}

	public function deleteQuote($quote_id)
	{
		$deleteQuote = Quote::find($quote_id);
		$flag = false;

		if (count($deleteQuote->author->quotes) === 1){
			$deleteQuote->author->delete();
			$flag = true;
		}

		$deleteQuote->delete();

		$msg = $flag ? 'Author and Quote deleted' : 'Quote deleted';

		return redirect()->route('home')->with(['success' => $msg]);
	}

	public function getEditQuote($quote_id)
	{
		$editQuote = Quote::find($quote_id);
		return view('edits.edit', ['quote' => $editQuote]);
	}

	public function postEditQuote(Request $request, $quote_id)
	{
		$this->validate($request, [
			'name' => 'required|max:60|alpha',
			'quote' => 'required|max:500'
		]);
		
		$editQuote = Quote::find($quote_id);
		$authorText = ucfirst($request['name']);
		// $quoteText = $request['quote'];

		// $editQuote->quote = $quoteText;

		// $editQuote->author->name = $authorText;
		// $editQuote->update();

		return redirect()->route('home')->with(['success' => 'Updated Successfully !']);
	}

	public function getMailCallback($author_name)
	{
		$author_log = new AuthorLog();
		$author_log->author = $author_name;
		$author_log->save();

		return view('email.callback', ['author' => $author_name]);
	}


}