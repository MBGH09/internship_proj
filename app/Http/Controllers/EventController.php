<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\mb_Event;
use App\Models\mb_Category;
use App\Models\mb_Registration;
use App\Models\mb_User;

class EventController extends Controller
{
    public function homeIndex()
    {
        // Si l'utilisateur est connecté, rediriger vers la page des événements
        if (Auth::check()) {
            return redirect()->route('events.index');
        }

        // Pour les guests, afficher la page publique des événements
        $search = request()->query('search');
        $categoryId = request()->query('category_id');
        $query = mb_Event::where('mb_is_active', true)
            ->where('mb_start_date', '>=', now());
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('mb_title', 'like', "%{$search}%")
                  ->orWhere('mb_description', 'like', "%{$search}%");
            });
        }
        if ($categoryId) {
            $query->where('mb_category_id', $categoryId);
        }
        
        $events = $query->orderBy('mb_start_date', 'asc')->paginate(12);
        $categories = mb_Category::all();
        
        return view('welcome', compact('events', 'categories', 'search', 'categoryId'));
    }

    public function index()
    {
        $search = request()->query('search');
        $categoryId = request()->query('category_id');
        $query = mb_Event::where('mb_is_active', true);
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('mb_title', 'like', "%{$search}%")
                  ->orWhere('mb_description', 'like', "%{$search}%");
            });
        }
        if ($categoryId) {
            $query->where('mb_category_id', $categoryId);
        }
        $events = $query->paginate(10);
        $categories = mb_Category::all();
        return view('user.events.index', compact('events', 'categories', 'search', 'categoryId'));
    }
        public function show(mb_Event $event)
    {
        // Vérifie si l'utilisateur est connecté
        $isRegistered = false;
        
        if (Auth::check()) {

            $isRegistered = $event->isUserRegistered(Auth::id());
        }

        $remainingCapacity = $event->getRemainingCapacity();
        
        return view('user.events.show', compact('event', 'isRegistered', 'remainingCapacity'));
    }
     public function create()
    {
        $categories = mb_Category::all();

        return view('admin.events.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mb_title' => 'required|string|max:255',
            'mb_description' => 'required|string',
            'mb_start_date' => 'required|date_format:Y-m-d\TH:i',
            'mb_end_date' => 'required|date_format:Y-m-d\TH:i|after_or_equal:mb_start_date',
            'mb_place' => 'required|string|max:255',
            'mb_price' => 'nullable|numeric|min:0',
            'mb_capacity' => 'required|integer|min:1',
            'mb_category_id' => 'required|exists:mb_categories,mb_cat_id',
            'mb_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'mb_title.required' => 'The title field is required.',
            'mb_description.required' => 'The description field is required.',
            'mb_start_date.required' => 'The start date field is required.',
            'mb_end_date.required' => 'The end date field is required.',
            'mb_place.required' => 'The place field is required.',
            'mb_capacity.required' => 'The capacity field is required.',
            'mb_category_id.required' => 'The category field is required.',
        ]);

        
        if ($request->hasFile('mb_image')) {
            
            $imagePath = $request->file('mb_image')->store('events', 'public');
            
            $validated['mb_image'] = $imagePath;
        }
        
        
        $validated['mb_is_free'] = ($validated['mb_price'] ?? 0) == 0;
        
        
        $validated['mb_created_by'] = Auth::id();
        
        
        mb_Event::create($validated);
        
        return redirect()->route('admin.events.index')->with('success', 'Événement créé avec succès!');
    }
    public function update(Request $request, mb_Event $event)
    {
        $validated = $request->validate([
            'mb_title' => 'required|string|max:255',
            'mb_description' => 'required|string',
            'mb_start_date' => 'required|date_format:Y-m-d\TH:i',
            'mb_end_date' => 'required|date_format:Y-m-d\TH:i|after_or_equal:mb_start_date',
            'mb_place' => 'required|string|max:255',
            'mb_price' => 'nullable|numeric|min:0',
            'mb_capacity' => 'required|integer|min:1',
            'mb_category_id' => 'required|exists:mb_categories,mb_cat_id',
            'mb_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'mb_title.required' => 'The title field is required.',
            'mb_description.required' => 'The description field is required.',
            'mb_start_date.required' => 'The start date field is required.',
            'mb_end_date.required' => 'The end date field is required.',
            'mb_place.required' => 'The place field is required.',
            'mb_capacity.required' => 'The capacity field is required.',
            'mb_category_id.required' => 'The category field is required.',
        ]);

        if ($request->hasFile('mb_image')) {
            $imagePath = $request->file('mb_image')->store('events', 'public');
            $validated['mb_image'] = $imagePath;
        }
        
        $validated['mb_is_free'] = ($validated['mb_price'] ?? 0) == 0;
        
        $event->update($validated);
        
        return redirect()->route('admin.events.index')->with('success', 'Événement modifié avec succès!');
    }
    public function destroy(mb_Event $event)
    {
        $event->delete();
        
        return redirect()->route('admin.events.index')->with('success', 'Événement supprimé avec succès!');
    }
    
    public function adminIndex()
    {
        $events = mb_Event::paginate(15);
        
        return view('admin.events.index', compact('events'));
    }

    public function adminRegistrations()
    {
        /** @var mb_User $user */
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $registrations = mb_Registration::with(['event', 'user'])
            ->latest()
            ->paginate(20);

        return view('admin.registrations.index', compact('registrations'));
    }
    
    public function register(Request $request, mb_Event $event)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour vous inscrire.');
        }
        
        $user = Auth::user();
        
        if ($event->isUserRegistered($user->mb_id)) {
            return back()->with('error', 'Vous êtes déjà inscrit à cet événement.');
        }
        
        if (!$event->hasAvailableSpots()) {
            return back()->with('error', 'Il n\'y a plus de places disponibles pour cet événement.');
        }
        
        // Crée l'inscription
        mb_Registration::create([
            'mb_user_id' => $user->mb_id,
            'mb_event_id' => $event->mb_event_id,
        ]);
        
        return back()->with('success', 'Vous êtes inscrit à cet événement!');
    }
    
    public function unregister(Request $request, mb_Event $event)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        
        mb_Registration::where('mb_user_id', $user->mb_id)->where('mb_event_id', $event->mb_event_id)->delete();
        
        return back()->with('success', 'Vous avez annulé votre inscription.');
    }

    
    public function myRegistrations()
    {
        // Cast Auth::user() to mb_User or fetch directly from mb_User model
        $user = mb_User::find(Auth::id());
        
        // Récupère tous les événements auxquels l'utilisateur est inscrit
        $events = $user->eventAttending()->paginate(15);
        
        // Retourne la vue avec les événements
        return view('user.registrations', compact('events'));
    }
    public function edit(mb_Event $event)
    {
        $categories = mb_Category::all();
        
        return view('admin.events.edit', compact('event', 'categories'));
    }
}