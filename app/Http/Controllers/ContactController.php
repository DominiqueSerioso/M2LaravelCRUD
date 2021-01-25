<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(5);
  
        return view('contacts.index',compact('contacts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    public function create()
    {
        return view('contacts.create');
    }
  
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phoneno' => 'required',
            'email' => 'required',
        ]);
  
        Contact::create($request->all());
   
        return redirect()->route('contacts.index')
                        ->with('success','Contact added successfully.');
    }
   
    public function show(Contact $contact)
    {
        return view('contacts.show',compact('contact'));
    }
   
    public function edit(Contact $contact)
    {
        return view('contacts.edit',compact('contact'));
    }
  
    
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required',
            'phoneno' => 'required',
            'email' => 'required',
        ]);
  
        $contact->update($request->all());
  
        return redirect()->route('contacts.index')
                        ->with('success','Contact updated successfully');
    }
  
    
    public function destroy(Contact $contact)
    {
        $contact->delete();
  
        return redirect()->route('contacts.index')
                        ->with('success','Contact deleted successfully');
    }
}
